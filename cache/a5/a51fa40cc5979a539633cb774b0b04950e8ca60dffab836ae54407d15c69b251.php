<?php

/* admin_product_add_success.html.twig */
class __TwigTemplate_1da0cd5cb8edac6a21cfbeab27eb5a0a8506e0da5ce8ed76b8b52240f35ff2d5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "admin_product_add_success.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "master.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Product add successful";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
    Product addedd. <img src=\"/";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["imagePath"]) ? $context["imagePath"] : null), "html", null, true);
        echo "\">
    
";
    }

    public function getTemplateName()
    {
        return "admin_product_add_success.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 7,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"master.html.twig\" %}

{% block title %}Product add successful{% endblock %}

{% block content %}

    Product addedd. <img src=\"/{{imagePath}}\">
    
{% endblock %}
    ", "admin_product_add_success.html.twig", "C:\\xampp\\htdocs\\ipd9\\slimshop\\templates\\admin_product_add_success.html.twig");
    }
}
