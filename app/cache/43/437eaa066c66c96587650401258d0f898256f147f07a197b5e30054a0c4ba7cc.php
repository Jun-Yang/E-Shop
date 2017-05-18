<?php

/* index.html.twig */
class __TwigTemplate_bbe05b1f7346dd018453ac87d41993879aa65ddd7b03a51dd88f58496a2dad05 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("master.html.twig", "index.html.twig", 1);
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
        echo "index";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
    <section class=\"jumbotron\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-7\">
                    <div class=\"animated fadeInLeft\"><!-- *** -->
                        <h1>Blue Scooter</h1>
                        <p class=\"lead\">
                            Blue Energy, Montreal,Canada, for full range of electric bike, mobility scooters and electric (motorized) wheelchairs. Wheelchair accessories include vehicle lifts, wheel chair ramps and much more. Check our quality used equipment or enquire about convenient and affordable scooter and wheel chair.
                        </p>
                        <a class=\"btn btn-primary btn-lg\" href=\"#!\">Find Out More</a>
                    </div><!-- *** -->  
                </div> <!-- /.col-md-7 -->

                <div class=\"col-md-5\">
                    <div class=\"animated fadeInUp\">
                        <img src=\"images/moto.png\" alt=\"moto\"/>
                    </div>
                </div> <!-- /.col-md-5 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section> <!-- /.jumbotron -->

    <section class=\"section-gray\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-3 col-md-3 text-center\">
                    <!-- FROM THE FONT AWESOME EXAMPLES -->
                    <span class=\"fa-stack fa-lg fa-4x\">
                        <i class=\"fa fa-circle fa-stack-2x fa-color\"></i>
                        <i class=\"fa fa-terminal fa-stack-1x fa-inverse\"></i>
                    </span>   
                    <h3>Valid Code</h3>
                </div>

                <div class=\"col-sm-3 col-md-3 text-center\">
                    <!-- FROM THE FONT AWESOME EXAMPLES -->
                    <span class=\"fa-stack fa-lg fa-4x\">
                        <i class=\"fa fa-circle fa-stack-2x fa-color\"></i>
                        <i class=\"fa fa-laptop fa-stack-1x fa-inverse\"></i>
                    </span> 
                    <h3>Responsive</h3>
                </div>

                <div class=\"col-sm-3 col-md-3 text-center\">
                    <!-- FROM THE FONT AWESOME EXAMPLES-->
                    <span class=\"fa-stack fa-lg fa-4x\">
                        <i class=\"fa fa-circle fa-stack-2x fa-color\"></i>
                        <i class=\"fa fa-video-camera fa-stack-1x fa-inverse\"></i>
                    </span>  
                    <h3>Animation Ready</h3>
                </div>

                <div class=\"col-sm-3 col-md-3 text-center\">
                    <!-- FROM THE FONT AWESOME EXAMPLES -->
                    <span class=\"fa-stack fa-lg fa-4x\">
                        <i class=\"fa fa-circle fa-stack-2x fa-color\"></i>
                        <i class=\"fa fa-gear fa-stack-1x fa-inverse\"></i>
                    </span>  
                    <h3>Customizable</h3>
                </div>                    
            </div>
        </div>
    </section>  

    <section class=\"section-secondary slogan\">
        <div class=\"container\">
            <h2>Take a closer look</h2>
            <p>Visit us in-store to try our exclusive brand new scooter and preview our cool collection. We have different model of electric bike, scooters and  </p>
            <a href=\"about.html\" class=\"btn btn-lg btn-default\">More Info</a> 
        </div>
    </section>

    <section>
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-6\">
                    <div class=\"wow fadeInLeft\">
                        <h2 class=\"page-header\">Powerful electric bike and mountain bike</h2>
                        <ul class=\"featured-list\">
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Electric Bike </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Electric Mountain Bike </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> City Scooters </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Mobile bike &amp; Content</li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Totally <strong>FREE</strong> to use </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Wheel chairs.</li>           
                        </ul>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"wow fadeInRight\">                    
                        <img src=\"images/bike.png\" alt=\"bike\" class=\"img-responsive\">
                    </div>
                </div>
            </div>
        </div>      
    </section>  

    <section class=\"section-primary\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"wow fadeIn\">                
                    <div class=\"col-md-6\">                    
                        <img class=\"img-responsive img-circle\" src=\"images/sample1.jpg\" alt=\"macbook\">          
                    </div>

                    <div class=\"col-md-6\">
                        <h2 class=\"page-header\">More Features Include...</h2>
                        <ul class=\"featured-list\">
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Mobility Scooters </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> mobility Sport Bike </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Free Style Bike </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Unstyled: Add Your Own Style &amp; </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> 100% <strong>FREE</strong> to use </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Cutomerize </li>           
                        </ul>
                    </div>
                </div>
            </div>
        </div>      
    </section>
    
";
    }

    public function getTemplateName()
    {
        return "index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 6,  35 => 5,  29 => 3,  11 => 1,);
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

{% block content %}

    <section class=\"jumbotron\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-7\">
                    <div class=\"animated fadeInLeft\"><!-- *** -->
                        <h1>Blue Scooter</h1>
                        <p class=\"lead\">
                            Blue Energy, Montreal,Canada, for full range of electric bike, mobility scooters and electric (motorized) wheelchairs. Wheelchair accessories include vehicle lifts, wheel chair ramps and much more. Check our quality used equipment or enquire about convenient and affordable scooter and wheel chair.
                        </p>
                        <a class=\"btn btn-primary btn-lg\" href=\"#!\">Find Out More</a>
                    </div><!-- *** -->  
                </div> <!-- /.col-md-7 -->

                <div class=\"col-md-5\">
                    <div class=\"animated fadeInUp\">
                        <img src=\"images/moto.png\" alt=\"moto\"/>
                    </div>
                </div> <!-- /.col-md-5 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section> <!-- /.jumbotron -->

    <section class=\"section-gray\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-sm-3 col-md-3 text-center\">
                    <!-- FROM THE FONT AWESOME EXAMPLES -->
                    <span class=\"fa-stack fa-lg fa-4x\">
                        <i class=\"fa fa-circle fa-stack-2x fa-color\"></i>
                        <i class=\"fa fa-terminal fa-stack-1x fa-inverse\"></i>
                    </span>   
                    <h3>Valid Code</h3>
                </div>

                <div class=\"col-sm-3 col-md-3 text-center\">
                    <!-- FROM THE FONT AWESOME EXAMPLES -->
                    <span class=\"fa-stack fa-lg fa-4x\">
                        <i class=\"fa fa-circle fa-stack-2x fa-color\"></i>
                        <i class=\"fa fa-laptop fa-stack-1x fa-inverse\"></i>
                    </span> 
                    <h3>Responsive</h3>
                </div>

                <div class=\"col-sm-3 col-md-3 text-center\">
                    <!-- FROM THE FONT AWESOME EXAMPLES-->
                    <span class=\"fa-stack fa-lg fa-4x\">
                        <i class=\"fa fa-circle fa-stack-2x fa-color\"></i>
                        <i class=\"fa fa-video-camera fa-stack-1x fa-inverse\"></i>
                    </span>  
                    <h3>Animation Ready</h3>
                </div>

                <div class=\"col-sm-3 col-md-3 text-center\">
                    <!-- FROM THE FONT AWESOME EXAMPLES -->
                    <span class=\"fa-stack fa-lg fa-4x\">
                        <i class=\"fa fa-circle fa-stack-2x fa-color\"></i>
                        <i class=\"fa fa-gear fa-stack-1x fa-inverse\"></i>
                    </span>  
                    <h3>Customizable</h3>
                </div>                    
            </div>
        </div>
    </section>  

    <section class=\"section-secondary slogan\">
        <div class=\"container\">
            <h2>Take a closer look</h2>
            <p>Visit us in-store to try our exclusive brand new scooter and preview our cool collection. We have different model of electric bike, scooters and  </p>
            <a href=\"about.html\" class=\"btn btn-lg btn-default\">More Info</a> 
        </div>
    </section>

    <section>
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-md-6\">
                    <div class=\"wow fadeInLeft\">
                        <h2 class=\"page-header\">Powerful electric bike and mountain bike</h2>
                        <ul class=\"featured-list\">
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Electric Bike </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Electric Mountain Bike </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> City Scooters </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Mobile bike &amp; Content</li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Totally <strong>FREE</strong> to use </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Wheel chairs.</li>           
                        </ul>
                    </div>
                </div>
                <div class=\"col-md-6\">
                    <div class=\"wow fadeInRight\">                    
                        <img src=\"images/bike.png\" alt=\"bike\" class=\"img-responsive\">
                    </div>
                </div>
            </div>
        </div>      
    </section>  

    <section class=\"section-primary\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"wow fadeIn\">                
                    <div class=\"col-md-6\">                    
                        <img class=\"img-responsive img-circle\" src=\"images/sample1.jpg\" alt=\"macbook\">          
                    </div>

                    <div class=\"col-md-6\">
                        <h2 class=\"page-header\">More Features Include...</h2>
                        <ul class=\"featured-list\">
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Mobility Scooters </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> mobility Sport Bike </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Free Style Bike </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Unstyled: Add Your Own Style &amp; </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> 100% <strong>FREE</strong> to use </li>
                            <li> <i class=\"glyphicon glyphicon-ok\"></i> Cutomerize </li>           
                        </ul>
                    </div>
                </div>
            </div>
        </div>      
    </section>
    
{% endblock content %}", "index.html.twig", "C:\\xampp\\htdocs\\php\\eshop\\app\\templates\\index.html.twig");
    }
}
