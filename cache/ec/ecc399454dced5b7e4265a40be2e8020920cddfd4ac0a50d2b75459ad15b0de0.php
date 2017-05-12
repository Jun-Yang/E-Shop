<?php

/* admin_product_add.html.twig */
class __TwigTemplate_a5aa434830b3c3b12f99ed17f2b93604deb78cec92f6d621fb9e87a62de83b3f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "admin_product_add.html.twig", 1);
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
        echo "Product add";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <form method=\"post\" enctype=\"multipart/form-data\">
        Product name: <input type=\"text\" name=\"name\"><br>
        Description: <textarea name=\"description\"></textarea><br>
        Image: <input type=\"file\" name=\"image\"><br>
        <input type=\"submit\" value=\"Add product\">
    </form>    
";
    }

    public function getTemplateName()
    {
        return "admin_product_add.html.twig";
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

{% block title %}Product add{% endblock %}

{% block content %}
    <form method=\"post\" enctype=\"multipart/form-data\">
        Product name: <input type=\"text\" name=\"name\"><br>
        Description: <textarea name=\"description\"></textarea><br>
        Image: <input type=\"file\" name=\"image\"><br>
        <input type=\"submit\" value=\"Add product\">
    </form>    
{% endblock %}
", "admin_product_add.html.twig", "C:\\xampp\\htdocs\\php\\slimshop\\templates\\admin_product_add.html.twig");
    }
}
