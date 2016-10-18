<?php
namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use App\Model\Talk;

class  TalkAction
{
    protected $talk;
    protected $template;

    public function __construct(Talk $talk, Template\TemplateRendererInterface $template = null)
    {
        $this->talk     = $talk;
        $this->template = $template;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $id = $request->getAttribute('id');
        if (null !== $id) {
            return $this->talk($id, $request, $response, $next);
        }

        $data = $this->talk->getAll();
        return new HtmlResponse($this->template->render('app::talks', [ 'talks' => $data ]));
    }

    public function talk($id, ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $data = $this->talk->getTalk($id);
        if (empty($data)) {
            return new HtmlResponse($this->template->render('error::404'));
        }
        return new HtmlResponse($this->template->render('app::talk', [ 'talk' => $data ]));
    }
}
