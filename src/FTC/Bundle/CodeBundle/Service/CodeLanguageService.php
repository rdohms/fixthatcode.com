<?php
namespace FTC\Bundle\CodeBundle\Service;

class CodeLanguageService
{
    protected $knownExtensions = array(
        "php" => array("php"),

    );

    protected $aceLanguages = array(
        "c_cpp","clojure","coffee","coldfusion","csharp","css","groovy","haxe","html","java","javascript","json",
        "latex","lua","markdown","ocaml","perl","pgsql","php","powershell","python","scala","scss","ruby","sql",
        "svg","text","xquery","textile","xml","sh",
    );

    protected $shLanguages = array(
        "as3","bash","cf","csharp","cpp","c","css","delphi","pascal","diff","patch","erlang","groovy","javascript",
        "java","javafx","pl","php","plain, text","powershell","python","ruby","scala","sql","vbnet","xml",
    );

    protected $languages = array(
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

    public function getLanguageList()
    {

    }

}



