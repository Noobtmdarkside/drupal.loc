<?php

/* modules/custom/clock/templates/clock.html.twig */
class __TwigTemplate_12c7eb724d66b310598be1a04c7324f570e2d8fc258bfec77d4eb947efb77f9e extends Twig_Template
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
        $tags = array();
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array(),
                array(),
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

        // line 1
        echo "<article class=\"clock\">
  <div class=\"hours-container\">
    <div class=\"hours\"></div>
  </div>
  <div class=\"minutes-container\">
    <div class=\"minutes\"></div>
  </div>
  <div class=\"seconds-container\">
    <div class=\"seconds\"></div>
  </div>
</article>";
    }

    public function getTemplateName()
    {
        return "modules/custom/clock/templates/clock.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<article class=\"clock\">
  <div class=\"hours-container\">
    <div class=\"hours\"></div>
  </div>
  <div class=\"minutes-container\">
    <div class=\"minutes\"></div>
  </div>
  <div class=\"seconds-container\">
    <div class=\"seconds\"></div>
  </div>
</article>", "modules/custom/clock/templates/clock.html.twig", "/var/www/drupal/modules/custom/clock/templates/clock.html.twig");
    }
}
