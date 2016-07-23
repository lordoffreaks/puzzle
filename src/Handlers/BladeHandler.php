<?php namespace Puzzle\Handlers;

use Illuminate\Contracts\View\Factory;
use Jigsaw\Jigsaw\ProcessedFile;
use Gettext\GettextTranslator;

class BladeHandler {
  private $viewFactory;
  /**
   * @var \Gettext\TranslatorInterface
   */
  protected $translator;

  public function __construct(Factory $viewFactory) {
    $this->viewFactory = $viewFactory;
    $this->translator = new GettextTranslator();
    $this->translator->register();
  }

  public function canHandle($file) {
    return ends_with($file->getFilename(), '.blade.php');
  }

  public function handle($file, $data) {
    $basename = $file->getBasename('.blade.php');
    $filename = $file->getBasename('.blade.php') . '.html';
    $data = $this->getMultiLangData($data, $basename);

    return new ProcessedFile($filename, $file->getRelativePath(), $this->render($file, $data));
  }

  public function render($file, $data) {
    return $this->viewFactory->make($this->getViewName($file), $data)->render();
  }

  private function getViewName($file) {
    return str_replace('/', '.', $file->getRelativePath()) . '.' . $file->getBasename('.blade.php');
  }

  private function getMultiLangData($data, $filename) {
    if (!empty($data['locale_templates']) && isset($data['locale_templates'][$filename])) {
      $language = $data['locale_templates'][$filename]['language'];
      $locale = $data['locale_templates'][$filename]['locale'];
      $country = $data['locale_templates'][$filename]['country'];
      $data = array_merge($data, $data[$language]);
    }
    else {
      $language = $data['default_language'];
      $locale = $data['default_locale'];
      $country = $data['default_country'];
    }

    $data['language'] = $language;
    $data['country'] = $country;
    $this->setLocale($locale, $data['locale_domain'], $data['locale_path']);

    return $data;
  }

  private function setLocale($locale, $domain, $path, $encoding = 'UTF-8') {

    putenv("LC_ALL=$locale");
    $this->translator
      ->setLanguage($locale, LC_ALL)
      ->loadDomain($domain, $path);
  }
}
