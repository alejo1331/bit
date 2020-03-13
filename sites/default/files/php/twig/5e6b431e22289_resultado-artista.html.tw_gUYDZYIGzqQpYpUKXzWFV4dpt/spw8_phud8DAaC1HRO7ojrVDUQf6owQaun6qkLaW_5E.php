<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/spotify/templates/resultado-artista.html.twig */
class __TwigTemplate_779876ad3ee2949421471678222249fd4d248a15a7fef39997155a2a0ad267b2 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 2, "for" => 30];
        $filters = ["escape" => 1, "raw" => 50];
        $functions = ["attach_library" => 1];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'for'],
                ['escape', 'raw'],
                ['attach_library']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->attachLibrary("spotify/spotify"), "html", null, true);
        echo "
";
        // line 2
        $context["infobasica"] = ($context["infoBasicaArtista"] ?? null);
        // line 3
        $context["listalbum"] = ($context["album"] ?? null);
        // line 4
        echo "
<div class=\"col-md-12 info-artista-id\">

    <div class=\"row\">

        <div class=\"col-md-12\">
                <div class=\"col-md-4 img-artist\">
                    <img src=\"";
        // line 11
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["infobasica"] ?? null), "images", []), 2, [], "array"), "url", [])), "html", null, true);
        echo "\" class=\"img-round\"/>
                </div>
                <div class=\"col-md-8 name-id-artista\" >

                    ";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["infobasica"] ?? null), "name", [])), "html", null, true);
        echo "
                    <div class=\"col-md-12 enlace-artista\">
                        <a href=\"";
        // line 17
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["infobasica"] ?? null), "external_urls", []), "spotify", [])), "html", null, true);
        echo "\" class=\"label-enlace\"> Ir a la página del artista</a>
                    </div>
                </div>

        </div>

        <div class=\"col-md-12\">
            <table>
                <tr>
                    <td> Foto</td>
                    <td> Album</td>
                    <td> Canción</td>
                </tr>
                ";
        // line 30
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["listalbum"] ?? null), "tracks", []));
        foreach ($context['_seq'] as $context["_key"] => $context["listal"]) {
            // line 31
            echo "                    <tr>
                        <td>
                            <img src=\"";
            // line 33
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["listal"], "album", []), "images", []), 2, [], "array"), "url", [])), "html", null, true);
            echo "\"/>
                        </td>
                        <td>
                            ";
            // line 36
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["listal"], "album", []), "name", [])), "html", null, true);
            echo "
                        </td>
                        <td>
                            ";
            // line 39
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["listal"], "name", [])), "html", null, true);
            echo "
                        </td>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['listal'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 43
        echo "
            </table>

        </div>

    
    </div>
        ";
        // line 50
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed(($context["info"] ?? null)));
        echo "
    

</div>";
    }

    public function getTemplateName()
    {
        return "modules/custom/spotify/templates/resultado-artista.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  139 => 50,  130 => 43,  120 => 39,  114 => 36,  108 => 33,  104 => 31,  100 => 30,  84 => 17,  79 => 15,  72 => 11,  63 => 4,  61 => 3,  59 => 2,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/spotify/templates/resultado-artista.html.twig", "C:\\wamp64\\www\\bits\\modules\\custom\\spotify\\templates\\resultado-artista.html.twig");
    }
}
