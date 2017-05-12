<?php

/* login_success.html.twig */
class __TwigTemplate_1fe713c4a3b720f8ea1f8b85ec831e2b4093b29fc620c22b927760dad73ec05c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "login_success.html.twig", 1);
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
        echo "Login successful";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    
<p>You've logged in succesfully.
    <a href=\"/add\">Add Product</a>. or
    <a href=\"/list\">List Product</a>.</p>
";
    }

    public function getTemplateName()
    {
        return "login_success.html.twig";
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

{% block title %}Login successful{% endblock %}

{% block content %}
    
<p>You've logged in succesfully.
    <a href=\"/add\">Add Product</a>. or
    <a href=\"/list\">List Product</a>.</p>
{% endblock content %}", "login_success.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\login_success.html.twig");
    }
}
