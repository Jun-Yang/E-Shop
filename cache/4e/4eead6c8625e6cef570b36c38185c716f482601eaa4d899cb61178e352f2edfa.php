<?php

/* admin_product_list.html.twig */
class __TwigTemplate_c64e448ad37ab158c8fd9dc4b487ebc7ada61841af2b8f8cd31d5f2aad44f872 extends Twig_Template
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
        $context['_seq'] = twig_ensure_traversable((isset($context["products"]) ? $context["products"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
            // line 14
            echo "          <tr>
            <td align=\"center\">";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "id", array()), "html", null, true);
            echo "</td>
            <td align=\"center\">";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "name", array()), "html", null, true);
            echo "</td>
            <td align=\"center\">";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "description", array()), "html", null, true);
            echo "</td>
            <td align=\"center\"><img src=\"/";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($context["row"], "imagePath", array()), "html", null, true);
            echo "\" height='100' width='200'/></td>
          </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
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
        return array (  75 => 21,  66 => 18,  62 => 17,  58 => 16,  54 => 15,  51 => 14,  47 => 13,  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
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
        {% for row in products %}
          <tr>
            <td align=\"center\">{{ row.id }}</td>
            <td align=\"center\">{{ row.name }}</td>
            <td align=\"center\">{{ row.description }}</td>
            <td align=\"center\"><img src=\"/{{ row.imagePath }}\" height='100' width='200'/></td>
          </tr>
        {% endfor %}
        </table>
    </form>    
        
{% endblock %}
", "admin_product_list.html.twig", "C:\\xampp\\htdocs\\php\\slimshop\\templates\\admin_product_list.html.twig");
    }
}
