<?php

/* register.html.twig */
class __TwigTemplate_1f9a441fa9c3801f86f2fada12efbc690a733320de989e6cf80a1f1f24b87044 extends Twig_Template
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
        echo "
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

";
    }

    // line 31
    public function block_content($context, array $blocks = array())
    {
        // line 32
        echo "
    <div class=\"register\">
        <h1 class=\"register-heading\">
            <strong> please register.</strong>
        </h1>
        <form method=\"post\">
            <input type=\"text\" name=\"name\" placeholder=\"username\" required=\"required\" class=\"input-txt\" />
            <input type=\"email\" name=\"email\" placeholder=\"email\" required=\"required\" class=\"input-txt\" value=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "email", array()), "html", null, true);
        echo "\"/>
            <input type=\"password\" name=\"pass1\" placeholder=\"password\" required=\"required\" class=\"input-txt\" />
            <input type=\"password\" name=\"pass2\" placeholder=\"password repeated\" required=\"required\" class=\"input-txt\" />
            <div class=\"register-footer\">
                <div class =\"error-message\">
                    ";
        // line 44
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 45
            echo "                        <ul class=\"errorList\">
                            ";
            // line 46
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 47
                echo "                                <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "                        </ul>
                    ";
        }
        // line 51
        echo "                </div>
                <span id=\"emailInUse\">Email already registered</span><br>
                <button type=\"submit\" class=\"btn btn--right\">Register</button>
            </div>
        </form>
    </div>

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
        return array (  108 => 51,  104 => 49,  95 => 47,  91 => 46,  88 => 45,  86 => 44,  78 => 39,  69 => 32,  66 => 31,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
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

    <div class=\"register\">
        <h1 class=\"register-heading\">
            <strong> please register.</strong>
        </h1>
        <form method=\"post\">
            <input type=\"text\" name=\"name\" placeholder=\"username\" required=\"required\" class=\"input-txt\" />
            <input type=\"email\" name=\"email\" placeholder=\"email\" required=\"required\" class=\"input-txt\" value=\"{{v.email}}\"/>
            <input type=\"password\" name=\"pass1\" placeholder=\"password\" required=\"required\" class=\"input-txt\" />
            <input type=\"password\" name=\"pass2\" placeholder=\"password repeated\" required=\"required\" class=\"input-txt\" />
            <div class=\"register-footer\">
                <div class =\"error-message\">
                    {% if errorList %}
                        <ul class=\"errorList\">
                            {% for error in errorList %}
                                <li>{{ error }}</li>
                                {% endfor %}
                        </ul>
                    {% endif %}
                </div>
                <span id=\"emailInUse\">Email already registered</span><br>
                <button type=\"submit\" class=\"btn btn--right\">Register</button>
            </div>
        </form>
    </div>

{% endblock content %}

", "register.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\register.html.twig");
    }
}
