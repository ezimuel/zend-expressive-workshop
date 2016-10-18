<?php
namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template;
use App\Model\Talk;

class ScheduleAction
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
        $data = [
          '2016-10-18' => $this->talk->getTalkByDate('2016-10-18'),
          '2016-10-19' => $this->talk->getTalkByDate('2016-10-19'),
          '2016-10-20' => $this->talk->getTalkByDate('2016-10-20'),
          '2016-10-21' => $this->talk->getTalkByDate('2016-10-21'),
        ];

        return new HtmlResponse($this->template->render('app::schedule', [ 'schedule' => $data ]));
    }
}
