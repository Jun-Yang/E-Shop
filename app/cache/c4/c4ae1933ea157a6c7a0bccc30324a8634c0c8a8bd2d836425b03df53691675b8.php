<?php

/* eshop.html.twig */
class __TwigTemplate_6343f46e5e91a6482f2be1ce0d6cb15fe4f42f3e6331088561eb479ee1fb5bf8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "eshop.html.twig", 1);
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
        echo "index";
    }

    // line 5
    public function block_headExtra($context, array $blocks = array())
    {
        // line 6
        echo "    <link href=\"/css/homepage.css\" rel=\"stylesheet\">
";
    }

    // line 9
    public function block_content($context, array $blocks = array())
    {
        // line 10
        echo "
    <div class=\"container\">
        <!-- Jumbotron Header -->
        <header class=\"jumbotron hero-spacer\">
            <h1>A Warm Welcome!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p>
                <a href=\"register\" class=\"btn btn-primary btn-lg\">Register</a>
                <a href=\"login\" class=\"btn btn-primary btn-lg\">Login</a>
                <a href=\"category\" class=\"btn btn-primary btn-lg\">category</a>
                <a href=\"list\" class=\"btn btn-primary btn-lg\">All Products</a>
            </p>
        </header>

        <!-- Title -->
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <h3>Latest Features</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class=\"row text-center\">
            <div class=\"col-md-3 col-sm-6 hero-feature\">
                <div class=\"thumbnail\">
                    <img src=\"images/moto2.png\" alt=\"\">
                    <div class=\"caption\">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href=\"login\" class=\"btn btn-primary\">Buy Now!</a> <a href=\"category\" class=\"btn btn-default\">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class=\"col-md-3 col-sm-6 hero-feature\">
                <div class=\"thumbnail\">
                    <img src=\"images/moto1.png\" alt=\"\">
                    <div class=\"caption\">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href=\"login\" class=\"btn btn-primary\">Buy Now!</a> <a href=\"product\" class=\"btn btn-default\">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class=\"col-md-3 col-sm-6 hero-feature\">
                <div class=\"thumbnail\">
                    <img src=\"images/bike.png\" alt=\"\">
                    <div class=\"caption\">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href=\"login\" class=\"btn btn-primary\">Buy Now!</a> <a href=\"#\" class=\"btn btn-default\">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class=\"col-md-3 col-sm-6 hero-feature\">
                <div class=\"thumbnail\">
                    <img src=\"images/bike1.png\" alt=\"\">
                    <div class=\"caption\">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href=\"login\" class=\"btn btn-primary\">Buy Now!</a> <a href=\"admin_user\" class=\"btn btn-default\">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    ";
    }

    public function getTemplateName()
    {
        return "eshop.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 10,  44 => 9,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
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

{% block title %}index{% endblock %}

{% block headExtra %}
    <link href=\"/css/homepage.css\" rel=\"stylesheet\">
{% endblock %}

{% block content %}

    <div class=\"container\">
        <!-- Jumbotron Header -->
        <header class=\"jumbotron hero-spacer\">
            <h1>A Warm Welcome!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p>
                <a href=\"register\" class=\"btn btn-primary btn-lg\">Register</a>
                <a href=\"login\" class=\"btn btn-primary btn-lg\">Login</a>
                <a href=\"category\" class=\"btn btn-primary btn-lg\">category</a>
                <a href=\"list\" class=\"btn btn-primary btn-lg\">All Products</a>
            </p>
        </header>

        <!-- Title -->
        <div class=\"row\">
            <div class=\"col-lg-12\">
                <h3>Latest Features</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class=\"row text-center\">
            <div class=\"col-md-3 col-sm-6 hero-feature\">
                <div class=\"thumbnail\">
                    <img src=\"images/moto2.png\" alt=\"\">
                    <div class=\"caption\">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href=\"login\" class=\"btn btn-primary\">Buy Now!</a> <a href=\"category\" class=\"btn btn-default\">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class=\"col-md-3 col-sm-6 hero-feature\">
                <div class=\"thumbnail\">
                    <img src=\"images/moto1.png\" alt=\"\">
                    <div class=\"caption\">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href=\"login\" class=\"btn btn-primary\">Buy Now!</a> <a href=\"product\" class=\"btn btn-default\">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class=\"col-md-3 col-sm-6 hero-feature\">
                <div class=\"thumbnail\">
                    <img src=\"images/bike.png\" alt=\"\">
                    <div class=\"caption\">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href=\"login\" class=\"btn btn-primary\">Buy Now!</a> <a href=\"#\" class=\"btn btn-default\">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class=\"col-md-3 col-sm-6 hero-feature\">
                <div class=\"thumbnail\">
                    <img src=\"images/bike1.png\" alt=\"\">
                    <div class=\"caption\">
                        <h3>Feature Label</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href=\"login\" class=\"btn btn-primary\">Buy Now!</a> <a href=\"admin_user\" class=\"btn btn-default\">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    {% endblock content %}", "eshop.html.twig", "C:\\xampp\\htdocs\\php\\eshop\\app\\templates\\eshop.html.twig");
    }
}
