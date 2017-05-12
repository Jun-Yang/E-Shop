<?php

/* edit_success.html.twig */
class __TwigTemplate_06bf2ca358033ff40ddc9a09796d847a239168e175ae953f10e6c9205c4c97a2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "edit_success.html.twig", 1);
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
        echo "Task edit successful";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <p>You can continue <a href=\"/add\">Add Product</a> 
        or
    <a href=\"/edit\">Edit Product</a>    
        or
    <a href=\"/delete\">delete Product</a>
        or
    <a href=\"/list\">List Product</a>.</p>
";
    }

    public function getTemplateName()
    {
        return "edit_success.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
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

{% block title %}Task edit successful{% endblock %}

{% block content %}
    <p>You can continue <a href=\"/add\">Add Product</a> 
        or
    <a href=\"/edit\">Edit Product</a>    
        or
    <a href=\"/delete\">delete Product</a>
        or
    <a href=\"/list\">List Product</a>.</p>
{% endblock %}
    ", "edit_success.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\edit_success.html.twig");
    }
}
