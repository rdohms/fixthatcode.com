<?php
namespace FTC\Bundle\CodeBundle\Entity\Choice;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class CodeLanguageChoices extends SimpleChoiceList
{
    /**
     * @var array
     */
    protected $reasons;

    /**
     * Redefine Constructor to internalize the creation of the choice list.
     */
    public function __construct()
    {
        $choices = array(
            "c_cpp" => "C/C++",
            "clojure" => "Clojure",
            "coffee" => "CoffeeScript",
            "coldfusion" => "ColdFusion",
            "csharp" => "C#",
            "css" => "CSS",
            "groovy" => "Groovy",
            "haxe" => "haXe",
            "html" => "HTML",
            "java" => "Java",
            "javascript" => "JavaScript",
            "json" => "JSON",
            "latex" => "LaTeX",
            "lua" => "Lua",
            "markdown" => "Markdown",
            "ocaml" => "OCaml",
            "perl" => "Perl",
            "pgsql" => "pgSQL",
            "php" => "PHP",
            "powershell" => "Powershell",
            "python" => "Python",
            "scala" => "Scala",
            "scss" => "SCSS",
            "ruby" => "Ruby",
            "sql" => "SQL",
            "svg" => "SVG",
            "text" => "Text",
            "xquery" => "XQuery",
            "textile" => "Textile",
            "xml" => "XML",
            "sh" => "SH",
        );

        parent::__construct($choices);
    }
}
