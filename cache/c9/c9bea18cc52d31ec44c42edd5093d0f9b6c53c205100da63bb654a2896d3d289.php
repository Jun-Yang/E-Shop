<?php

/* register_success.html.twig */
class __TwigTemplate_3f6e9319a7d24e1b17fc7085fad5e421b63e82a0f184404070128f1b68f81deb extends Twig_Template
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
        // line 2
        echo "
<p>Registration successful. You may now <a href=\"/login\">login</a>.</p>

";
    }

    public function getTemplateName()
    {
        return "register_success.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 2,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{# empty Twig template #}

<p>Registration successful. You may now <a href=\"/login\">login</a>.</p>

", "register_success.html.twig", "C:\\xampp\\htdocs\\ipd9\\slimshop\\templates\\register_success.html.twig");
    }
}
