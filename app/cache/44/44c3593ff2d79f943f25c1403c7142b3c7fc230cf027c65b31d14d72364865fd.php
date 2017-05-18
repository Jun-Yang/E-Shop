<?php

/* master.html.twig */
class __TwigTemplate_536b9dcc04da76e8a0fb480d380f75e38b1d211e0461e70e4cdbd71b2e69ed8a extends Twig_Template
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
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">
        <!-- BOOTSTRAP CORE CSS -->
        <link href=\"css/bootstrap.css\" rel=\"stylesheet\">
        <!-- ANIMATE CSS -->
        <link href=\"css/animate.css\" rel=\"stylesheet\">
        <!-- FONT AWESOME -->
        <link href=\"css/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\"> 
        <!-- GOOGLE FONTS -->  
        <link href=\"https://fonts.googleapis.com/css?family=Oswald:400,500,700\" rel=\"stylesheet\">
        <!-- Custom Styles For This Template -->
        <link href=\"css/style.css\" rel=\"stylesheet\">
        <title>";
        // line 19
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    ";
        // line 20
        $this->displayBlock('headExtra', $context, $blocks);
        // line 21
        echo "    <link rel=\"icon\" href=\"images/favicon2.ico\">
  

</head>

<body>
    <!-- Navigation -->
    <nav class=\"navbar navbar-default navbar-fixed-top\">
        <div class=\"container\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand logo-nav\" href=\"#\">
                    <img src=\"images/logo.png\" alt=\"logo\">      
                </a>
            </div>

            <div id=\"navbar\" class=\"collapse navbar-collapse\">
                <ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"index\">Home</a></li>
                    <li><a href=\"about\">About</a></li>
                    <li><a href=\"services\">Services</a></li>
                    <li><a href=\"eshop\">eShop</a></li>
                    <li><a href=\"contact\">Contact</a></li>
                    <li><br>
                        <div id=\"header\" class=\"login_user_right\">
                            ";
        // line 51
        if ((isset($context["eshopuser"]) ? $context["eshopuser"] : null)) {
            // line 52
            echo "                                &nbsp;&nbsp;&nbsp; Welcome ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["eshopuser"]) ? $context["eshopuser"] : null), "name", array()), "html", null, true);
            echo ", you may <a href=\"/logout\">Logout</a>
                            ";
        } else {
            // line 54
            echo "                                &nbsp;&nbsp;&nbsp; You may <a href=\"/login\">Login</a> or <a href=\"/register\">Register</a>
                            ";
        }
        // line 56
        echo "                        </div>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div id=\"content\">
    ";
        // line 64
        $this->displayBlock('content', $context, $blocks);
        // line 65
        echo "    </div>

    <footer>            
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <br/>
                <p>Business Theme Copyright &copy; 2017 - <a href=\"#!\">Terms</a> &middot; <a href=\"#\">Privacy</a></p>
            </div>
        </div>            
    </footer>   

<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
<script src=\"scripts/bootstrap.js\"></script>
<script src=\"scripts/wow.js\"></script>
<script type=\"application/javascript\">
    new WOW().init();
</script>

</body>
</html>";
    }

    // line 19
    public function block_title($context, array $blocks = array())
    {
    }

    // line 20
    public function block_headExtra($context, array $blocks = array())
    {
    }

    // line 64
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
        return array (  137 => 64,  132 => 20,  127 => 19,  104 => 65,  102 => 64,  92 => 56,  88 => 54,  82 => 52,  80 => 51,  48 => 21,  46 => 20,  42 => 19,  22 => 1,);
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
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"description\" content=\"\">
        <meta name=\"author\" content=\"\">
        <!-- BOOTSTRAP CORE CSS -->
        <link href=\"css/bootstrap.css\" rel=\"stylesheet\">
        <!-- ANIMATE CSS -->
        <link href=\"css/animate.css\" rel=\"stylesheet\">
        <!-- FONT AWESOME -->
        <link href=\"css/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\"> 
        <!-- GOOGLE FONTS -->  
        <link href=\"https://fonts.googleapis.com/css?family=Oswald:400,500,700\" rel=\"stylesheet\">
        <!-- Custom Styles For This Template -->
        <link href=\"css/style.css\" rel=\"stylesheet\">
        <title>{% block title %}{% endblock %}</title>
    {% block headExtra %}{% endblock %}
    <link rel=\"icon\" href=\"images/favicon2.ico\">
  

</head>

<body>
    <!-- Navigation -->
    <nav class=\"navbar navbar-default navbar-fixed-top\">
        <div class=\"container\">
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                </button>
                <a class=\"navbar-brand logo-nav\" href=\"#\">
                    <img src=\"images/logo.png\" alt=\"logo\">      
                </a>
            </div>

            <div id=\"navbar\" class=\"collapse navbar-collapse\">
                <ul class=\"nav navbar-nav navbar-right\">
                    <li><a href=\"index\">Home</a></li>
                    <li><a href=\"about\">About</a></li>
                    <li><a href=\"services\">Services</a></li>
                    <li><a href=\"eshop\">eShop</a></li>
                    <li><a href=\"contact\">Contact</a></li>
                    <li><br>
                        <div id=\"header\" class=\"login_user_right\">
                            {% if eshopuser %}
                                &nbsp;&nbsp;&nbsp; Welcome {{ eshopuser.name }}, you may <a href=\"/logout\">Logout</a>
                            {% else %}
                                &nbsp;&nbsp;&nbsp; You may <a href=\"/login\">Login</a> or <a href=\"/register\">Register</a>
                            {% endif %}
                        </div>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div id=\"content\">
    {% block content %}{% endblock content %}
    </div>

    <footer>            
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <br/>
                <p>Business Theme Copyright &copy; 2017 - <a href=\"#!\">Terms</a> &middot; <a href=\"#\">Privacy</a></p>
            </div>
        </div>            
    </footer>   

<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>
<script src=\"scripts/bootstrap.js\"></script>
<script src=\"scripts/wow.js\"></script>
<script type=\"application/javascript\">
    new WOW().init();
</script>

</body>
</html>", "master.html.twig", "C:\\xampp\\htdocs\\php\\eshop\\app\\templates\\master.html.twig");
    }
}
