<?php

namespace Mothership\TwigBemBundle\Twig;

use Twig\Error\Error;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Erweitert TWIG mit den BEM-Funktionen `bemBlock` und `bemElem`
 */
class BemExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'bemBlock',
                [$this, 'buildBemBlock'],
                [
                    'needs_context' => true,
                    'is_safe' => ['html']
                ]
            ),
            new TwigFunction(
                'bemElem',
                [$this, 'buildBemElement'],
                [
                    'needs_context' => true,
                    'is_safe' => ['html']
                ]
            )
        ];
    }

    /**
     * Baut BEM-Block Klassen aus dem Blocknamen und optionalen Modifier zusammen.
     * @throws Error
     */
    public function buildBemBlock(array &$context, string $bemBlock, $modifiers = array()): string
    {
        /*
         * ACHTUNG: der Context ist hier eine Referenz und modifiziert diesen daher an dieser Stelle.
         * Das ist aber Absicht, damit folgende BEM-Elemente den hier gesetzten Block in ihren Klassen-Namen benutzen können.
         */
        $context["bemBlock"] = $bemBlock;
        $classes = [$bemBlock];

        foreach ($modifiers as $modifier) {
            $classes[] = $bemBlock . "--" . $modifier;
        }

        return implode(" ", $classes);
    }

    /**
     * Baut eine BEM-Element Klassen aus dem Elementnamen und optionalen Modifier zusammen.
     * Der Block-Name kommt aus dem Context und muss zuvor über `bemBlock` gesetzt worden sein.
     * @throws Error
     */
    public function buildBemElement(array $context, string $element, $modifiers = array()): string
    {
        $bemBlock = $context['bemBlock'] ?? null;
        if (!$bemBlock) {
            throw new Error("No BEM Block defined! Please use `bemBlock(BLOCK_NAME)` on a parent-element.");
        }
        $element = $bemBlock . "__" . $element;
        $classes = [$element];

        foreach ($modifiers as $modifier) {
            $classes[] = $element . "--" . $modifier;
        }

        return implode(" ", $classes);
    }
}
