<?php

/* admin_todo_add.html.twig */
class __TwigTemplate_6d9e531db0c47b0f443d876a5900b38fbd9e7e67d598dfe2e7a6d19e194f8d43 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "admin_todo_add.html.twig", 1);
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
        echo "    <div class=\"add-product\">
        <h1 class=\"add-product-heading\">
            <strong>Welcome.</strong> Product list.</h1>
        <form method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"text\" name=\"task\" placeholder=\"Task\" required=\"required\" class=\"input-txt\" />
            <input type=\"date\" name=\"dueDate\" placeholder=\"DueDate\" required=\"required\" class=\"input-txt\" />
            <label> Is Done</label>
            <input type=\"checkbox\" name=\"isDone\" value=\"checked\" placeholder=\"IsDone\" required=\"required\" class=\"input-txt\" />
";
        // line 15
        echo "            ";
        // line 16
        echo "            <div class=\"add-product-footer\">
                <a href=\"#\" class=\"lnk\">
                    <span class=\"icon icon--min\">ಠ╭╮ಠ</span> 
                    I've forgotten something
                </a>
                <button type=\"submit\" class=\"btn btn--right\">Add product</button>

            </div>
        </form>
    </div>

";
    }

    public function getTemplateName()
    {
        return "admin_todo_add.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 16,  48 => 15,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
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
    <div class=\"add-product\">
        <h1 class=\"add-product-heading\">
            <strong>Welcome.</strong> Product list.</h1>
        <form method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"text\" name=\"task\" placeholder=\"Task\" required=\"required\" class=\"input-txt\" />
            <input type=\"date\" name=\"dueDate\" placeholder=\"DueDate\" required=\"required\" class=\"input-txt\" />
            <label> Is Done</label>
            <input type=\"checkbox\" name=\"isDone\" value=\"checked\" placeholder=\"IsDone\" required=\"required\" class=\"input-txt\" />
{#            <textarea name=\"description\" placeholder=\"Description\" required=\"required\" class=\"input-txt\"></textarea>#}
            {#Image: <input type=\"file\" name=\"image\"><br>#}
            <div class=\"add-product-footer\">
                <a href=\"#\" class=\"lnk\">
                    <span class=\"icon icon--min\">ಠ╭╮ಠ</span> 
                    I've forgotten something
                </a>
                <button type=\"submit\" class=\"btn btn--right\">Add product</button>

            </div>
        </form>
    </div>

{% endblock %}
", "admin_todo_add.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\admin_todo_add.html.twig");
    }
}
