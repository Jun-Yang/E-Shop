<?php

/* edit.html.twig */
class __TwigTemplate_5e8d75715d5597e2ddbcd2e52fcec485682f2f47a4255a23ba0f88938d65dba9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "edit.html.twig", 1);
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
        echo "Product edit";
    }

    // line 5
    public function block_headExtra($context, array $blocks = array())
    {
        // line 6
        echo "
<script>
    \$(document).ready(function() {
        \$(\"#taskNameInUse\").hide();
        \$(\"input[name=task]\").keyup(function() {
            var taskName = \$(this).val();
            //console.log(\"Keyup: \" + email);
            if (taskName === \"\") {
                \$(\"#taskNameInUse\").hide();
                return;
            }
            \$.get(\"/ajax/tasknameused/\" + task, function(result) {
                result = eval(result);
                if (result) {
                    \$(\"#taskNameInUse\").show();
                } else {
                    \$(\"#taskNameInUse\").hide();
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
        echo "    <div class=\"edit-product\">
        <h1 class=\"edit-product-heading\">
            <strong>Edit Product</strong>
        </h1>
        <form method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"text\" name=\"task\" placeholder=\"Task\" required=\"required\" class=\"input-txt\" value=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["todo"]) ? $context["todo"] : null), "task", array()), "html", null, true);
        echo "\"/>
            <input type=\"date\" name=\"dueDate\" placeholder=\"DueDate\" required=\"required\" class=\"input-txt\" value=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["todo"]) ? $context["todo"] : null), "dueDate", array()), "html", null, true);
        echo "\" />
            <select id=\"isDone\" name=\"isDone\" required=\"required\" class=\"input-txt\">
                <option <?php if(\$result == 'Pending'){ echo ' selected=\"selected\"'; } value=\"Pending\">Pending</option>
                <option <?php if(\$result == 'Done'){ echo ' selected=\"selected\"'; } value=\"Done\">Done</option>
            </select>
";
        // line 44
        echo "            ";
        // line 45
        echo "            <div class=\"edit-product-footer\">
                <div class =\"error-message\">
                    ";
        // line 47
        if ((isset($context["errorList"]) ? $context["errorList"] : null)) {
            // line 48
            echo "                        <ul class=\"errorList\">
                            ";
            // line 49
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errorList"]) ? $context["errorList"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 50
                echo "                                <li>";
                echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                echo "</li>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            echo "                        </ul>
                    ";
        }
        // line 54
        echo "                </div>
                <button type=\"submit\" class=\"btn btn--right\">Edit Product</button>             
            </div>
        </form>
    </div>

";
    }

    public function getTemplateName()
    {
        return "edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 54,  112 => 52,  103 => 50,  99 => 49,  96 => 48,  94 => 47,  90 => 45,  88 => 44,  80 => 38,  76 => 37,  69 => 32,  66 => 31,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
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

{% block title %}Product edit{% endblock %}

{% block headExtra %}

<script>
    \$(document).ready(function() {
        \$(\"#taskNameInUse\").hide();
        \$(\"input[name=task]\").keyup(function() {
            var taskName = \$(this).val();
            //console.log(\"Keyup: \" + email);
            if (taskName === \"\") {
                \$(\"#taskNameInUse\").hide();
                return;
            }
            \$.get(\"/ajax/tasknameused/\" + task, function(result) {
                result = eval(result);
                if (result) {
                    \$(\"#taskNameInUse\").show();
                } else {
                    \$(\"#taskNameInUse\").hide();
                }
            });
        });
    });
</script>

{% endblock headExtra %}

{% block content %}
    <div class=\"edit-product\">
        <h1 class=\"edit-product-heading\">
            <strong>Edit Product</strong>
        </h1>
        <form method=\"post\" enctype=\"multipart/form-data\">
            <input type=\"text\" name=\"task\" placeholder=\"Task\" required=\"required\" class=\"input-txt\" value=\"{{todo.task}}\"/>
            <input type=\"date\" name=\"dueDate\" placeholder=\"DueDate\" required=\"required\" class=\"input-txt\" value=\"{{todo.dueDate}}\" />
            <select id=\"isDone\" name=\"isDone\" required=\"required\" class=\"input-txt\">
                <option <?php if(\$result == 'Pending'){ echo ' selected=\"selected\"'; } value=\"Pending\">Pending</option>
                <option <?php if(\$result == 'Done'){ echo ' selected=\"selected\"'; } value=\"Done\">Done</option>
            </select>
{#            <textarea name=\"description\" placeholder=\"Description\" required=\"required\" class=\"input-txt\"></textarea>#}
            {#Image: <input type=\"file\" name=\"image\"><br>#}
            <div class=\"edit-product-footer\">
                <div class =\"error-message\">
                    {% if errorList %}
                        <ul class=\"errorList\">
                            {% for error in errorList %}
                                <li>{{ error }}</li>
                                {% endfor %}
                        </ul>
                    {% endif %}
                </div>
                <button type=\"submit\" class=\"btn btn--right\">Edit Product</button>             
            </div>
        </form>
    </div>

{% endblock %}
", "edit.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\edit.html.twig");
    }
}
