<?php

/* login.html.twig */
class __TwigTemplate_d5600422d73966f7de387c60782b031f58f2d8bc49bc4e51c9de4a9eac6a7dea extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "login.html.twig", 1);
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

    // line 2
    public function block_title($context, array $blocks = array())
    {
        echo "Login";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "
    <div class=\"login\">
        <h1 class=\"login-heading\">
            <strong> Please login</strong>
        </h1>
        <form method=\"post\">
            <input type=\"text\" name=\"name\" placeholder=\"username\" required=\"required\" class=\"input-txt\" />
            <input type=\"password\" name=\"password\" placeholder=\"password\" required=\"required\" class=\"input-txt\" />
            <div class=\"login-footer\">
                <button type=\"submit\" class=\"btn\">Login</button>
                <button type=\"submit\" class=\"btn btn--right\"><a href=\"/register\" class='btn--no--underline'>Register</a></button>
                ";
        // line 16
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 17
            echo "                    <p class=\"errorList\">Login failed try again.</p>
                ";
        }
        // line 19
        echo "            </div>
        </form>
    </div>

";
    }

    public function getTemplateName()
    {
        return "login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 19,  53 => 17,  51 => 16,  38 => 5,  35 => 4,  29 => 2,  11 => 1,);
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
{% block title %}Login{% endblock %}

{% block content %}

    <div class=\"login\">
        <h1 class=\"login-heading\">
            <strong> Please login</strong>
        </h1>
        <form method=\"post\">
            <input type=\"text\" name=\"name\" placeholder=\"username\" required=\"required\" class=\"input-txt\" />
            <input type=\"password\" name=\"password\" placeholder=\"password\" required=\"required\" class=\"input-txt\" />
            <div class=\"login-footer\">
                <button type=\"submit\" class=\"btn\">Login</button>
                <button type=\"submit\" class=\"btn btn--right\"><a href=\"/register\" class='btn--no--underline'>Register</a></button>
                {% if error %}
                    <p class=\"errorList\">Login failed try again.</p>
                {% endif %}
            </div>
        </form>
    </div>

{% endblock content %}

", "login.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\login.html.twig");
    }
}
