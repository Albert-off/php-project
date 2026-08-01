<?php
declare(strict_types=1);

namespace App\Rendering;

use Symfony\Component\HttpFoundation\Response;


final class Renderer
{
    public function __construct(
        private readonly ViewEnvironment $environment,
    ) {}

    // Он НЕ знает Request, Session, Cookie, Header - Он просто знает "если ты хочешь HTML-ответ, я могу тебе его собрать."
    public function html(View $view, int $status = 200): Response
    {
        // return Response::html(  
        //     $this->render($view),
        //     $status
        // );
        return new Response(
            $this->render($view),
            $status,
            [
                'Content-Type' => 'text/html; charset=UTF-8',
            ]
        );
    }

    public function render(View $view): string 
    {
        // file_put_contents(
        //     BASE_PATH . 'debug.txt',
        //     $this->view->layout($layout)
        // );

        $data = array_merge(
            $view->data,
            [
                'asset'     => fn(string $path) => $this->environment->asset($path),
                'component' => fn(string $name) => $this->environment->component($name),
                'url'       => fn(string $path = '') => $this->environment->siteUrl($path),

                'baseUrl'   => $this->environment->baseUrl(),
                'siteUrl'   => $this->environment->siteUrl(''),

                // пока оставляем
                'view'      => $this->environment,
            ]
        );

        $content = $this->renderFile(
            $this->environment->view($view->template),
            $data
        );

        return $this->renderFile(
            $this->environment->layout($view->layout),

            array_merge(
                $data,
                [
                    'content' => $content,
                ]
            )
        );
    }

    private function renderFile(string $file, array $data, string $type = 'View'): string
    {
        if (!is_file($file)) {
            throw ViewException::missing($type, $file);
        }

        extract($data, EXTR_SKIP);

        ob_start();

        require $file;

        return ob_get_clean();
    }
}