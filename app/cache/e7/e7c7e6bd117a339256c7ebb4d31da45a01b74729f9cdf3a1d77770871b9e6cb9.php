<?php

/* register.html.twig */
class __TwigTemplate_38ca3dc0ccb90a82554f358abf9cc0d52d904ba1e27730e03ef06497e789fa97 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "register.html.twig", 1);
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

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "User registration";
    }

    // line 5
    public function block_headExtra($context, array $blocks = array())
    {
        // line 6
        echo "    <script>
        \$(document).ready(function () {
            \$(\"#emailInUse\").hide();
            \$(\"input[name=email]\").keyup(function () {
                var email = \$(this).val();
                //console.log(\"Keyup: \" + email);
                if (email === \"\") {
                    \$(\"#emailInUse\").hide();
                    return;
                }
                \$.get(\"/ajax/emailused/\" + email, function (result) {
                    result = eval(result);
                    if (result) {
                        \$(\"#emailInUse\").show();
                    } else {
                        \$(\"#emailInUse\").hide();
                    }
                });
            });
        });
    </script>

";
    }

    // line 30
    public function block_content($context, array $blocks = array())
    {
        // line 31
        echo "
    <div class=\"container\">
        

            <div class=\"row\">
                <div class=\"col-md-6\">
                    <div class=\"wow bounceInUp\">   
                        <br>
                        <br>
                        <img src=\"images/model01.png\" class=\"img-responsive\" width=\"480\" height=\"340\">
                    </div>
                </div>

                <div class=\"col-md-6\">    
                    <div class=\"wow fadeIn\">                        
                        <!--<h2>Welcome to our company</h2>-->
                        <div class=\"login\">
                            <h1 class=\"login-heading\">
                               Register to Blue Scooter
                            </h1>
                            <hr>

                            <form method=\"post\">
                                <div class=\"form-group\">
                                    <label>User Name</label><br>
                                    <input type=\"text\" name=\"name\" placeholder=\"username\" class=\"login_form input-txt\" required=\"required\" />
                                </div>
                                <div class=\"form-group\">
                                    <label>Email</label><br>
                                    <input type=\"email\" name=\"email\" placeholder=\"email\" required=\"required\" class=\"login_form\" value=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "email", array()), "html", null, true);
        echo "\"/>
                                </div>
                                <div class=\"form-group\">
                                    <label>Password</label><br>
                                    <input type=\"password\" name=\"pass1\" placeholder=\"password\" required=\"required\" class=\"login_form\" /></div>    
                                <div class=\"form-group\">
                                    <label>Password Repeat</label><br>
                                    <input type=\"password\" name=\"pass2\" placeholder=\"password repeated\" required=\"required\" class=\"login_form\" />
                                </div>
                                <div class=\"login-footer\">
                                    <div class =\"error-message\">
                                        ";
        // line 71
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 72
            echo "                                            <ul class=\"errorList\">
                                                ";
            // line 73
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 74
                echo "                                                    <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
                                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 76
            echo "                                            </ul>
                                        ";
        }
        // line 78
        echo "                                    </div>
                                    ";
        // line 80
        echo "
                                    <button type=\"submit\" class=\"btn btn-primary btn-lg\">Register</button>
                                    ";
        // line 82
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 83
            echo "                                        <p class=\"errorList\">Register failed try again.</p>
                                    ";
        }
        // line 85
        echo "                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div> <!-- /.row -->
        
    </div>


    <hr>
";
    }

    public function getTemplateName()
    {
        return "register.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  148 => 85,  144 => 83,  142 => 82,  138 => 80,  135 => 78,  131 => 76,  122 => 74,  118 => 73,  115 => 72,  113 => 71,  99 => 60,  68 => 31,  65 => 30,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
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

{% block title %}User registration{% endblock %}

{% block headExtra %}
    <script>
        \$(document).ready(function () {
            \$(\"#emailInUse\").hide();
            \$(\"input[name=email]\").keyup(function () {
                var email = \$(this).val();
                //console.log(\"Keyup: \" + email);
                if (email === \"\") {
                    \$(\"#emailInUse\").hide();
                    return;
                }
                \$.get(\"/ajax/emailused/\" + email, function (result) {
                    result = eval(result);
                    if (result) {
                        \$(\"#emailInUse\").show();
                    } else {
                        \$(\"#emailInUse\").hide();
                    }
                });
            });
        });
    </script>

{% endblock headExtra %}

{% block content %}

    <div class=\"container\">
        

            <div class=\"row\">
                <div class=\"col-md-6\">
                    <div class=\"wow bounceInUp\">   
                        <br>
                        <br>
                        <img src=\"images/model01.png\" class=\"img-responsive\" width=\"480\" height=\"340\">
                    </div>
                </div>

                <div class=\"col-md-6\">    
                    <div class=\"wow fadeIn\">                        
                        <!--<h2>Welcome to our company</h2>-->
                        <div class=\"login\">
                            <h1 class=\"login-heading\">
                               Register to Blue Scooter
                            </h1>
                            <hr>

                            <form method=\"post\">
                                <div class=\"form-group\">
                                    <label>User Name</label><br>
                                    <input type=\"text\" name=\"name\" placeholder=\"username\" class=\"login_form input-txt\" required=\"required\" />
                                </div>
                                <div class=\"form-group\">
                                    <label>Email</label><br>
                                    <input type=\"email\" name=\"email\" placeholder=\"email\" required=\"required\" class=\"login_form\" value=\"{{v.email}}\"/>
                                </div>
                                <div class=\"form-group\">
                                    <label>Password</label><br>
                                    <input type=\"password\" name=\"pass1\" placeholder=\"password\" required=\"required\" class=\"login_form\" /></div>    
                                <div class=\"form-group\">
                                    <label>Password Repeat</label><br>
                                    <input type=\"password\" name=\"pass2\" placeholder=\"password repeated\" required=\"required\" class=\"login_form\" />
                                </div>
                                <div class=\"login-footer\">
                                    <div class =\"error-message\">
                                        {% if errorList %}
                                            <ul class=\"errorList\">
                                                {% for error in errorList %}
                                                    <li>{{ error }}</li>
                                                    {% endfor %}
                                            </ul>
                                        {% endif %}
                                    </div>
                                    {#                        <span id=\"emailInUse\">Email already registered</span><br>#}

                                    <button type=\"submit\" class=\"btn btn-primary btn-lg\">Register</button>
                                    {% if error %}
                                        <p class=\"errorList\">Register failed try again.</p>
                                    {% endif %}
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div> <!-- /.row -->
        
    </div>


    <hr>
{% endblock content %}

", "register.html.twig", "C:\\xampp\\htdocs\\php\\eshop\\app\\templates\\register.html.twig");
    }
}
