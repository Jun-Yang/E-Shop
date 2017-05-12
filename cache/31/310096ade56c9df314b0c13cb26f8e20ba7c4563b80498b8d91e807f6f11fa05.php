<?php

/* admin_todo_add.html.twig */
class __TwigTemplate_978d5c9adb7b4bd03a437e0bff7c12d982ba50f15ff8560afd6cd186f6aa3427 extends Twig_Template
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
            <strong>Add Product</strong>
        </h1>
        <form method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"text\" name=\"task\" placeholder=\"Task\" required=\"required\" class=\"input-txt\" />
            <input type=\"date\" name=\"dueDate\" placeholder=\"DueDate\" required=\"required\" class=\"input-txt\" />
            <select name=\"isDone\" required=\"required\" class=\"input-txt\" />
              <option value=\"Pending\">Pending</option>
              <option value=\"Done\">Done</option>
            </select>
";
        // line 18
        echo "            ";
        // line 19
        echo "            <div class=\"add-product-footer\">
                <a href=\"#\" class=\"lnk\">
                    <span class=\"icon icon--min\">ಠ╭╮ಠ</span> 
                    I've forgotten something
                </a>
                <button type=\"submit\" class=\"btn btn--right\">Add Product</button>
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
        return array (  53 => 19,  51 => 18,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
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
            <strong>Add Product</strong>
        </h1>
        <form method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"text\" name=\"task\" placeholder=\"Task\" required=\"required\" class=\"input-txt\" />
            <input type=\"date\" name=\"dueDate\" placeholder=\"DueDate\" required=\"required\" class=\"input-txt\" />
            <select name=\"isDone\" required=\"required\" class=\"input-txt\" />
              <option value=\"Pending\">Pending</option>
              <option value=\"Done\">Done</option>
            </select>
{#            <textarea name=\"description\" placeholder=\"Description\" required=\"required\" class=\"input-txt\"></textarea>#}
            {#Image: <input type=\"file\" name=\"image\"><br>#}
            <div class=\"add-product-footer\">
                <a href=\"#\" class=\"lnk\">
                    <span class=\"icon icon--min\">ಠ╭╮ಠ</span> 
                    I've forgotten something
                </a>
                <button type=\"submit\" class=\"btn btn--right\">Add Product</button>
            </div>
        </form>
    </div>

{% endblock %}
", "admin_todo_add.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\admin_todo_add.html.twig");
    }
}
