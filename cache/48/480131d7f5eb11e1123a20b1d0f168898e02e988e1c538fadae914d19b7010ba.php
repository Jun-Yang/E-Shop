<?php

/* admin_product_list.html.twig */
class __TwigTemplate_1bb4c7bd5da61b5764e5ee4b18bd279dcbab0c55f1bc220efafce6420af0ae2f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "admin_product_list.html.twig", 1);
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
        echo "    
    <form method=\"post\" >
       <table>
        <th width = 50px>Id</th>
        <th width = 100px>Name</th>
        <th width = 200px>Description</th>
        <th width = 200px>Image</th>
        ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["products"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["p"]) {
            // line 14
            echo "          <tr>
            <td>";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "name", array()), "html", null, true);
            echo "</td>
            <td>";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "description", array()), "html", null, true);
            echo "</td>
            <td><img src=\"/";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "imagePath", array()), "html", null, true);
            echo "\" height='100' width='200'/></td>
            <td><a href=\"/admin/product/edit/";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "\">edit</a>
            <td><a href=\"/admin/product/delete/";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($context["p"], "id", array()), "html", null, true);
            echo "\">delete</a>
          </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['p'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "        </table>
    </form>    
        
";
    }

    public function getTemplateName()
    {
        return "admin_product_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 23,  74 => 20,  70 => 19,  66 => 18,  62 => 17,  58 => 16,  54 => 15,  51 => 14,  47 => 13,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
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
    
    <form method=\"post\" >
       <table>
        <th width = 50px>Id</th>
        <th width = 100px>Name</th>
        <th width = 200px>Description</th>
        <th width = 200px>Image</th>
        {% for p in products %}
          <tr>
            <td>{{ p.id }}</td>
            <td>{{ p.name }}</td>
            <td>{{ p.description }}</td>
            <td><img src=\"/{{ p.imagePath }}\" height='100' width='200'/></td>
            <td><a href=\"/admin/product/edit/{{p.id}}\">edit</a>
            <td><a href=\"/admin/product/delete/{{p.id}}\">delete</a>
          </tr>
        {% endfor %}
        </table>
    </form>    
        
{% endblock %}
", "admin_product_list.html.twig", "C:\\xampp\\htdocs\\php\\slimshop\\templates\\admin_product_list.html.twig");
    }
}
