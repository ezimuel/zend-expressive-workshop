<?php
namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use App\Model\Speaker;

class SpeakerAction
{
    protected $speaker;
    protected $template;

    public function __construct(Speaker $speaker,  Template\TemplateRendererInterface $template = null)
    {
        $this->speaker  = $speaker;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $id = $request->getAttribute('id');
        if (null !== $id) {
            return $this->speaker($id, $request, $response, $next);
        }

        $data = $this->speaker->getAll();
        return new HtmlResponse($this->template->render('app::speakers', [ 'speakers' => $data ]));
    }

    public function speaker($id, ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $data = $this->speaker->getSpeaker($id);
        if (empty($data)) {
            return new HtmlResponse($this->template->render('error::404'));
        }
        return new HtmlResponse($this->template->render('app::speaker', [ 'speaker' => $data ]));
    }
}
