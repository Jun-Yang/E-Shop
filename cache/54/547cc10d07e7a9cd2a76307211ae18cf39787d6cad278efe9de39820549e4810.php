<?php

/* list.html.twig */
class __TwigTemplate_ee9dea5d8314a62d2129d3dc81ed3fa0c89f8248270e6d49d0f61b6d9787e9ca extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "list.html.twig", 1);
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
        echo "Product list";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"list-product\">
        <h1 class=\"list-product-heading\">
            <strong>List Product</strong>
        </h1>
        <form method=\"post\" >
            <table>
                <th width = 100px>Task</th>
                <th width = 200px>DueDate</th>
                <th width = 200px>Is Done</th>
                    ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["todos"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["t"]) {
            // line 16
            echo "                    <tr>
                        <td>";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "task", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "dueDate", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "isDone", array()), "html", null, true);
            echo "</td>
                        <td><a href=\"/edit/";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "id", array()), "html", null, true);
            echo "\">Edit</a>
                        <td><a href=\"/delete/";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($context["t"], "id", array()), "html", null, true);
            echo "\">Delete</a>
                    </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['t'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "            </table>
            <div class=\"list-product-footer\">
                <div class =\"error-message\">
                    You can edit or delete task in this page.
                </div>
                <button type=\"submit\" class=\"btn btn--right\"><a href=\"/add\" class='btn--no--underline'>Add Task</a></button>
            </div>
        </form>    
    </div>

";
    }

    public function getTemplateName()
    {
        return "list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 24,  72 => 21,  68 => 20,  64 => 19,  60 => 18,  56 => 17,  53 => 16,  49 => 15,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
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

{% block title %}Product list{% endblock %}

{% block content %}
    <div class=\"list-product\">
        <h1 class=\"list-product-heading\">
            <strong>List Product</strong>
        </h1>
        <form method=\"post\" >
            <table>
                <th width = 100px>Task</th>
                <th width = 200px>DueDate</th>
                <th width = 200px>Is Done</th>
                    {% for t in todos %}
                    <tr>
                        <td>{{ t.task }}</td>
                        <td>{{ t.dueDate }}</td>
                        <td>{{ t.isDone }}</td>
                        <td><a href=\"/edit/{{t.id}}\">Edit</a>
                        <td><a href=\"/delete/{{t.id}}\">Delete</a>
                    </tr>
                {% endfor %}
            </table>
            <div class=\"list-product-footer\">
                <div class =\"error-message\">
                    You can edit or delete task in this page.
                </div>
                <button type=\"submit\" class=\"btn btn--right\"><a href=\"/add\" class='btn--no--underline'>Add Task</a></button>
            </div>
        </form>    
    </div>

{% endblock %}
", "list.html.twig", "C:\\xampp\\htdocs\\php\\slimtodo\\templates\\list.html.twig");
    }
}
