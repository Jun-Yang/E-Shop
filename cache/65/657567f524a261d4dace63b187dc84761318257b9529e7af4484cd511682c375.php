<?php

/* logout.html.twig */
class __TwigTemplate_05ec8a57d2de966bdeccf26db4fc328065e0240837ad3ee30628db486b8a6423 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "logout.html.twig", 1);
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
        echo "Logout successful";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
<p>You've logged out succesfully.
    <a href=\"/login\">Click to login</a>.</p>

";
    }

    public function getTemplateName()
    {
        return "logout.html.twig";
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

{% block title %}Logout successful{% endblock %}

{% block content %}

<p>You've logged out succesfully.
    <a href=\"/login\">Click to login</a>.</p>

{% endblock content %}
", "logout.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\logout.html.twig");
    }
}
