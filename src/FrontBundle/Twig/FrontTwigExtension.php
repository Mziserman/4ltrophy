<?php
namespace FrontBundle\Twig;

class FrontTwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('tweet', [
                $this,
                'tweetFilter',
            ]),
        ];
    }

    public function tweetFilter($text)
    {
        $hashtags = [
            '#4LTrophy',
            '#4lTrophy',
            '#4ltrophy',
            '#4Ltrophy',
        ];

        preg_match_all('/(?!\b)(@\w+\b)/', $text, $matchesArobas);
        // I don't know why returns an array with twice the result :/
        $matchesArobas = $matchesArobas[0];

        preg_match_all('/(?!\b)(#\w+\b)/', $text, $matchesHashtags);
        // I don't know why returns an array with twice the result :/
        $matchesHashtags = $matchesHashtags[0];

        foreach($matchesArobas as $match) {
            if (empty((array) $match)) continue;
            $text = str_replace($match, '<a href="https://twitter.com/'. ltrim($match, "@") .'" class="arobas" target="_blank">' . $match . '</a>', $text);
        }

        // Let's find hashtags and apply style to them
        foreach($matchesHashtags as $match) {
            if (in_array($match, $hashtags)) {
                $text = str_replace($match, '<a href="https://twitter.com/hashtag/'. ltrim($match, "#") .'" class="hashtag trophy" target="_blank">' . $match . '</a>', $text);
            } else {
                $text = str_replace($match, '<a href="https://twitter.com/hashtag/'. ltrim($match, "#") .'" class="hashtag" target="_blank">' . $match . '</a>', $text);
            }
        }

        return $text;
    }

    public function getName()
    {
        return 'FrontTwigExtensions';
    }
}
