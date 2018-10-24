<?php

/* themes/custom/sub_bootstrap/templates/menu--account.html.twig */
class __TwigTemplate_d2cf51bdcbe8725475505a4898855ac38ab38b2be57ecb1d7fbba464927486d6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("if" => 19, "set" => 30);
        $filters = array("clean_class" => 32);
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('if', 'set'),
                array('clean_class'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 19
        if (($context["login"] ?? null)) {
            // line 20
            echo "<div class=\"login-user\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["login"] ?? null), "html", null, true));
            echo "</div>
";
        }
        // line 22
        if (($context["name"] ?? null)) {
            // line 23
            echo "<div class=\"logged_name\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["name"] ?? null), "html", null, true));
            echo "</div>
";
        }
        // line 25
        if (($context["Logout"] ?? null)) {
            // line 26
            echo "<div class=\"logout\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["Logout"] ?? null), "html", null, true));
            echo "</div>
";
        }
        // line 28
        echo "
";
        // line 30
        $context["classes"] = array(0 => "menu", 1 => ("menu--" . \Drupal\Component\Utility\Html::getClass(        // line 32
($context["menu_name"] ?? null))), 2 => "nav", 3 => "navbar-nav", 4 => "navbar-right");
    }

    public function getTemplateName()
    {
        return "themes/custom/sub_bootstrap/templates/menu--account.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 32,  70 => 30,  67 => 28,  61 => 26,  59 => 25,  53 => 23,  51 => 22,  45 => 20,  43 => 19,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#
/**
 * @file
 * Default theme implementation to display a menu.
 *
 * Available variables:
 * - menu_name: The machine name of the menu.
 * - items: A nested list of menu items. Each menu item contains:
 *   - attributes: HTML attributes for the menu item.
 *   - below: The menu item child items.
 *   - title: The menu link title.
 *   - url: The menu link url, instance of \\Drupal\\Core\\Url
 *   - localized_options: Menu link localized options.
 *
 * @ingroup templates
 */
#}
{#{% extends \"menu.html.twig\" %}#}
{% if  login %}
<div class=\"login-user\">{{ login }}</div>
{% endif %}
{% if  name %}
<div class=\"logged_name\">{{ name }}</div>
{% endif %}
{% if  Logout %}
<div class=\"logout\">{{ Logout }}</div>
{% endif %}

{%
  set classes = [
    'menu',
    'menu--' ~ menu_name|clean_class,
    'nav',
    'navbar-nav',
    'navbar-right',
  ]
%}
", "themes/custom/sub_bootstrap/templates/menu--account.html.twig", "/var/www/drupal/themes/custom/sub_bootstrap/templates/menu--account.html.twig");
    }
}
