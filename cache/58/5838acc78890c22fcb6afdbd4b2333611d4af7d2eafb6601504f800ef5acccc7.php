<?php

/* master.html.twig */
class __TwigTemplate_d191c7f90a1bbac00453b8a0a81fb1bf376d2c665fd27f673689b5bde9773d35 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'headExtra' => array($this, 'block_headExtra'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css\">
        <link rel=\"stylesheet\" href=\"/styles.css\"/>
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
        <meta charset=\"UTF-8\">
        <title>";
        // line 8
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    ";
        // line 9
        $this->displayBlock('headExtra', $context, $blocks);
        // line 10
        echo "</head>
<body>
    <div class=\"container\">
        <div id=\"header\">
            ";
        // line 14
        if ((isset($context["todouser"]) ? $context["todouser"] : null)) {
            // line 15
            echo "                Welcome ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["todouser"]) ? $context["todouser"] : null), "name", array()), "html", null, true);
            echo ", you may <a href=\"/logout\">logout</a>.
            ";
        } else {
            // line 17
            echo "                ";
            // line 18
            echo "            ";
        }
        // line 19
        echo "        </div>
        <div id=\"content\">
        ";
        // line 21
        $this->displayBlock('content', $context, $blocks);
        // line 22
        echo "        </div>
    </div>    
    <div id=\"footer\">            
        &copy; Copyright 2011 by <a href=\"http://domain.invalid/\">you</a>.            
    </div>    
</body>
</html>";
    }

    // line 8
    public function block_title($context, array $blocks = array())
    {
    }

    // line 9
    public function block_headExtra($context, array $blocks = array())
    {
    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "master.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 21,  77 => 9,  72 => 8,  62 => 22,  60 => 21,  56 => 19,  53 => 18,  51 => 17,  45 => 15,  43 => 14,  37 => 10,  35 => 9,  31 => 8,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
    <head>
        <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css\">
        <link rel=\"stylesheet\" href=\"/styles.css\"/>
        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
        <meta charset=\"UTF-8\">
        <title>{% block title %}{% endblock %}</title>
    {% block headExtra %}{% endblock %}
</head>
<body>
    <div class=\"container\">
        <div id=\"header\">
            {% if todouser %}
                Welcome {{ todouser.name }}, you may <a href=\"/logout\">logout</a>.
            {% else %}
                {#                    Welcome, You may <a href=\"/login\">login</a> or <a href=\"/register\">register</a>.#}
            {% endif %}
        </div>
        <div id=\"content\">
        {% block content %}{% endblock content %}
        </div>
    </div>    
    <div id=\"footer\">            
        &copy; Copyright 2011 by <a href=\"http://domain.invalid/\">you</a>.            
    </div>    
</body>
</html>", "master.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\master.html.twig");
    }
}
