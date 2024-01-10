<?php

namespace App\Request;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use App\Config\StackOverflowConfig;

class StackOverflowRequest
{

    public function setFromRequest(Request $request, string $type): void
    {
        $this->order = $request->get('order');
        $this->sort = $request->get('sort');
        $this->page = $request->get('page');
        $this->pagesize = $request->get('pagesize');
        $this->todate = $request->get('todate');
        $this->max = $request->get('max');
        $this->fromdate = $request->get('fromdate');
        $this->min = $request->get('min');

        if ($type === StackOverflowConfig::QUESTION_VARIABLE ) {
            $sort = $request->get('sort');
            if (in_array($sort, StackOverflowConfig::QUESTION_SORT_OPTIONS)) {
                throw new \InvalidArgumentException('Invalid sort option for questions.');
            }
            
            $min = $request->get('min');
            $max = $request->get('max');
            if ($min !== null || $max !== null) {
                throw new \InvalidArgumentException('Min and Max are not applicable for questions.');
            }
    
            $this->tagged = $request->get('tagged');
        }
    
        if ($type === StackOverflowConfig::POSTS_VARIABLE | $type === StackOverflowConfig::ANSWERS_VARIABLE ) {
            $sort = $request->get('sort');
            if (in_array($sort, StackOverflowConfig::POST_RESTRICTED_SORT_OPTIONS)) {
                throw new \InvalidArgumentException('Sort option not allowed for posts.');
            }
        }
    }

    /**
     * @Assert\Choice(choices={"desc", "asc"}, message="Order should be either 'desc' or 'asc'.")
     */
    public $order;

    /**
     * @Assert\Choice(choices={"activity", "creation", "votes"}, message="Sort should be either 'activity', 'creation', or 'votes'.")
     */
    public $sort;

    /**
     * @Assert\PositiveOrZero(message="Page should be a positive integer or zero.")
     */
    public $page;

    /**
     * @Assert\PositiveOrZero(message="Pagesize should be a positive integer or zero.")
     */
    public $pagesize;

    /**
     * @Assert\Date(message="Todate should be a valid date.")
     */
    public $todate;

    /**
     * @Assert\PositiveOrZero(message="Max should be a positive integer or zero.")
     */
    public $max;

    /**
     * @Assert\Date(message="Fromdate should be a valid date.")
     */
    public $fromdate;

    /**
     * @Assert\PositiveOrZero(message="Min should be a positive integer or zero.")
     */
    public $min;
    
    /**
     * @Assert\Type(type={"null", "string"})
     */
    public $tagged;
}
