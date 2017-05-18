<?php

/* login.html.twig */
class __TwigTemplate_68a938ff4f57b64247ffd904465ce4a3ed7776ba29182f612cbbc8ad4373faf3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "login.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'headExtra' => array($this, 'block_headExtra'),
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
    public function block_headExtra($context, array $blocks = array())
    {
        // line 5
        echo "    <link href=\"css/bootstrap-social.css\" rel=\"stylesheet\">
    <script type=\"text/javascript\">
        document.getElementById(\"passreset\").onclick = function () {
            location.href = \"passreset\";
        };
    </script>
";
    }

    // line 13
    public function block_content($context, array $blocks = array())
    {
        // line 14
        echo "    <div class=\"container\">
        <div class=\"container\">

            <div class=\"row\">
                <div class=\"col-md-6\">
                    <div class=\"wow bounceInUp\">
                        <br>
                        <br>                      
                        <img src=\"images/model02.png\" class=\"img-responsive\" width=\"480\" height=\"540\">
                    </div>
                </div>

                <div class=\"col-md-6\">    
                    <div class=\"wow fadeIn\">                        
                        <!--<h2>Welcome to our company</h2>-->
                        <div class=\"login\">
                            <h1 class=\"login-heading\">
                                Log in to Blue Scooter
                            </h1>
                            <hr>

                            <form method=\"post\">
                                <div class=\"form-group\">
                                    <label>User Name</label><br>
                                    <input type=\"text\" name=\"name\" placeholder=\"username\" class=\"login_form input-txt\" required=\"required\" />
                                </div>

                                <div class=\"form-group\">
                                    <label>Password</label><br>
                                    <input type=\"password\" name=\"pass\" placeholder=\"password\" class=\"login_form input-txt\" required=\"required\" />
                                </div>    
                                <div class=\"login-footer\">
                                    <button type=\"submit\" class=\"btn-lg btn-primary col-xs-2 col-md-2\">Log in</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href=\"/passreset\">Forget password?</a>
                                    <a class=\"btn-lg btn-social-icon btn-facebook col-xs-1 col-md-1 pull-right\">
                                        <span class=\"fa fa-facebook\"></span>
                                    </a>
                                    <a class=\"btn-lg btn-social-icon btn-twitter col-xs-1 col-md-1 pull-right\">
                                        <span class=\"fa fa-twitter\"></span>
                                    </a>
                                    <a class=\"btn-lg btn-social-icon btn-google col-xs-1 col-md-1 pull-right\">
                                        <span class=\"fa fa-google\"></span>
                                    </a>
                                    <a class=\"btn-lg btn-social-icon btn-instagram col-xs-1 col-md-1 pull-right\">
                                        <span class=\"fa fa-instagram\"></span>
                                    </a>
                                    ";
        // line 61
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 62
            echo "                                        <p class=\"errorList\">Login failed try again.</p>
                                    ";
        }
        // line 64
        echo "                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div>
    </div>
    <hr>
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
        return array (  107 => 64,  103 => 62,  101 => 61,  52 => 14,  49 => 13,  39 => 5,  36 => 4,  30 => 2,  11 => 1,);
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

{% block headExtra %}
    <link href=\"css/bootstrap-social.css\" rel=\"stylesheet\">
    <script type=\"text/javascript\">
        document.getElementById(\"passreset\").onclick = function () {
            location.href = \"passreset\";
        };
    </script>
{% endblock %}

{% block content %}
    <div class=\"container\">
        <div class=\"container\">

            <div class=\"row\">
                <div class=\"col-md-6\">
                    <div class=\"wow bounceInUp\">
                        <br>
                        <br>                      
                        <img src=\"images/model02.png\" class=\"img-responsive\" width=\"480\" height=\"540\">
                    </div>
                </div>

                <div class=\"col-md-6\">    
                    <div class=\"wow fadeIn\">                        
                        <!--<h2>Welcome to our company</h2>-->
                        <div class=\"login\">
                            <h1 class=\"login-heading\">
                                Log in to Blue Scooter
                            </h1>
                            <hr>

                            <form method=\"post\">
                                <div class=\"form-group\">
                                    <label>User Name</label><br>
                                    <input type=\"text\" name=\"name\" placeholder=\"username\" class=\"login_form input-txt\" required=\"required\" />
                                </div>

                                <div class=\"form-group\">
                                    <label>Password</label><br>
                                    <input type=\"password\" name=\"pass\" placeholder=\"password\" class=\"login_form input-txt\" required=\"required\" />
                                </div>    
                                <div class=\"login-footer\">
                                    <button type=\"submit\" class=\"btn-lg btn-primary col-xs-2 col-md-2\">Log in</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href=\"/passreset\">Forget password?</a>
                                    <a class=\"btn-lg btn-social-icon btn-facebook col-xs-1 col-md-1 pull-right\">
                                        <span class=\"fa fa-facebook\"></span>
                                    </a>
                                    <a class=\"btn-lg btn-social-icon btn-twitter col-xs-1 col-md-1 pull-right\">
                                        <span class=\"fa fa-twitter\"></span>
                                    </a>
                                    <a class=\"btn-lg btn-social-icon btn-google col-xs-1 col-md-1 pull-right\">
                                        <span class=\"fa fa-google\"></span>
                                    </a>
                                    <a class=\"btn-lg btn-social-icon btn-instagram col-xs-1 col-md-1 pull-right\">
                                        <span class=\"fa fa-instagram\"></span>
                                    </a>
                                    {% if error %}
                                        <p class=\"errorList\">Login failed try again.</p>
                                    {% endif %}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- /.row -->
        </div>
    </div>
    <hr>
{% endblock content %}

", "login.html.twig", "C:\\xampp\\htdocs\\php\\eshop\\app\\templates\\login.html.twig");
    }
}
