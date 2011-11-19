var NAVTREE =
[
  [ "PHPSVG", "index.html", [
    [ "Data Structures", "annotated.html", [
      [ "Inkscape", "class_inkscape.html", null ],
      [ "SVGCircle", "class_s_v_g_circle.html", null ],
      [ "SVGDocument", "class_s_v_g_document.html", null ],
      [ "SVGEllipse", "class_s_v_g_ellipse.html", null ],
      [ "SVGImage", "class_s_v_g_image.html", null ],
      [ "SVGLine", "class_s_v_g_line.html", null ],
      [ "SVGLinearGradient", "class_s_v_g_linear_gradient.html", null ],
      [ "SVGPath", "class_s_v_g_path.html", null ],
      [ "SVGRadialGradient", "class_s_v_g_radial_gradient.html", null ],
      [ "SVGRect", "class_s_v_g_rect.html", null ],
      [ "SVGShape", "class_s_v_g_shape.html", null ],
      [ "SVGShapeEx", "class_s_v_g_shape_ex.html", null ],
      [ "SVGStop", "class_s_v_g_stop.html", null ],
      [ "SVGStyle", "class_s_v_g_style.html", null ],
      [ "SVGText", "class_s_v_g_text.html", null ],
      [ "XmlElement", "class_xml_element.html", null ]
    ] ],
    [ "Data Structure Index", "classes.html", null ],
    [ "Class Hierarchy", "hierarchy.html", [
      [ "Inkscape", "class_inkscape.html", null ],
      [ "SVGDocument", "class_s_v_g_document.html", null ],
      [ "SVGImage", "class_s_v_g_image.html", null ],
      [ "SVGShape", "class_s_v_g_shape.html", [
        [ "SVGPath", "class_s_v_g_path.html", null ],
        [ "SVGShapeEx", "class_s_v_g_shape_ex.html", [
          [ "SVGCircle", "class_s_v_g_circle.html", null ],
          [ "SVGEllipse", "class_s_v_g_ellipse.html", null ],
          [ "SVGLine", "class_s_v_g_line.html", null ],
          [ "SVGRect", "class_s_v_g_rect.html", null ]
        ] ],
        [ "SVGText", "class_s_v_g_text.html", null ]
      ] ],
      [ "SVGStyle", "class_s_v_g_style.html", null ],
      [ "XmlElement", "class_xml_element.html", [
        [ "SVGLinearGradient", "class_s_v_g_linear_gradient.html", [
          [ "SVGRadialGradient", "class_s_v_g_radial_gradient.html", null ]
        ] ],
        [ "SVGStop", "class_s_v_g_stop.html", null ]
      ] ]
    ] ],
    [ "Data Fields", "functions.html", null ],
    [ "File List", "files.html", [
      [ "/home/trialforce/svn/phpsvg/svglib/inkscape.php", "inkscape_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgcircle.php", "svgcircle_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgellipse.php", "svgellipse_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgimage.php", "svgimage_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svglib.php", "svglib_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgline.php", "svgline_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svglineargradient.php", "svglineargradient_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgpath.php", "svgpath_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgradialgradient.php", "svgradialgradient_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgrect.php", "svgrect_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgshape.php", "svgshape_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgshapeex.php", "svgshapeex_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgstop.php", "svgstop_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgstyle.php", "svgstyle_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/svgtext.php", "svgtext_8php.html", null ],
      [ "/home/trialforce/svn/phpsvg/svglib/xmlelement.php", "xmlelement_8php.html", null ]
    ] ],
    [ "Examples", "examples.html", [
      [ "file_put_contents", "file_put_contents-example.html", null ],
      [ "setHeight", "set_height-example.html", null ],
      [ "setWidth", "set_width-example.html", null ],
      [ "svg-", "svg--example.html", null ],
      [ "this-", "this--example.html", null ]
    ] ]
  ] ]
];

function createIndent(o,domNode,node,level)
{
  if (node.parentNode && node.parentNode.parentNode)
  {
    createIndent(o,domNode,node.parentNode,level+1);
  }
  var imgNode = document.createElement("img");
  if (level==0 && node.childrenData)
  {
    node.plus_img = imgNode;
    node.expandToggle = document.createElement("a");
    node.expandToggle.href = "javascript:void(0)";
    node.expandToggle.onclick = function() 
    {
      if (node.expanded) 
      {
        $(node.getChildrenUL()).slideUp("fast");
        if (node.isLast)
        {
          node.plus_img.src = node.relpath+"ftv2plastnode.png";
        }
        else
        {
          node.plus_img.src = node.relpath+"ftv2pnode.png";
        }
        node.expanded = false;
      } 
      else 
      {
        expandNode(o, node, false);
      }
    }
    node.expandToggle.appendChild(imgNode);
    domNode.appendChild(node.expandToggle);
  }
  else
  {
    domNode.appendChild(imgNode);
  }
  if (level==0)
  {
    if (node.isLast)
    {
      if (node.childrenData)
      {
        imgNode.src = node.relpath+"ftv2plastnode.png";
      }
      else
      {
        imgNode.src = node.relpath+"ftv2lastnode.png";
        domNode.appendChild(imgNode);
      }
    }
    else
    {
      if (node.childrenData)
      {
        imgNode.src = node.relpath+"ftv2pnode.png";
      }
      else
      {
        imgNode.src = node.relpath+"ftv2node.png";
        domNode.appendChild(imgNode);
      }
    }
  }
  else
  {
    if (node.isLast)
    {
      imgNode.src = node.relpath+"ftv2blank.png";
    }
    else
    {
      imgNode.src = node.relpath+"ftv2vertline.png";
    }
  }
  imgNode.border = "0";
}

function newNode(o, po, text, link, childrenData, lastNode)
{
  var node = new Object();
  node.children = Array();
  node.childrenData = childrenData;
  node.depth = po.depth + 1;
  node.relpath = po.relpath;
  node.isLast = lastNode;

  node.li = document.createElement("li");
  po.getChildrenUL().appendChild(node.li);
  node.parentNode = po;

  node.itemDiv = document.createElement("div");
  node.itemDiv.className = "item";

  node.labelSpan = document.createElement("span");
  node.labelSpan.className = "label";

  createIndent(o,node.itemDiv,node,0);
  node.itemDiv.appendChild(node.labelSpan);
  node.li.appendChild(node.itemDiv);

  var a = document.createElement("a");
  node.labelSpan.appendChild(a);
  node.label = document.createTextNode(text);
  a.appendChild(node.label);
  if (link) 
  {
    a.href = node.relpath+link;
  } 
  else 
  {
    if (childrenData != null) 
    {
      a.className = "nolink";
      a.href = "javascript:void(0)";
      a.onclick = node.expandToggle.onclick;
      node.expanded = false;
    }
  }

  node.childrenUL = null;
  node.getChildrenUL = function() 
  {
    if (!node.childrenUL) 
    {
      node.childrenUL = document.createElement("ul");
      node.childrenUL.className = "children_ul";
      node.childrenUL.style.display = "none";
      node.li.appendChild(node.childrenUL);
    }
    return node.childrenUL;
  };

  return node;
}

function showRoot()
{
  var headerHeight = $("#top").height();
  var footerHeight = $("#nav-path").height();
  var windowHeight = $(window).height() - headerHeight - footerHeight;
  navtree.scrollTo('#selected',0,{offset:-windowHeight/2});
}

function expandNode(o, node, imm)
{
  if (node.childrenData && !node.expanded) 
  {
    if (!node.childrenVisited) 
    {
      getNode(o, node);
    }
    if (imm)
    {
      $(node.getChildrenUL()).show();
    } 
    else 
    {
      $(node.getChildrenUL()).slideDown("fast",showRoot);
    }
    if (node.isLast)
    {
      node.plus_img.src = node.relpath+"ftv2mlastnode.png";
    }
    else
    {
      node.plus_img.src = node.relpath+"ftv2mnode.png";
    }
    node.expanded = true;
  }
}

function getNode(o, po)
{
  po.childrenVisited = true;
  var l = po.childrenData.length-1;
  for (var i in po.childrenData) 
  {
    var nodeData = po.childrenData[i];
    po.children[i] = newNode(o, po, nodeData[0], nodeData[1], nodeData[2],
        i==l);
  }
}

function findNavTreePage(url, data)
{
  var nodes = data;
  var result = null;
  for (var i in nodes) 
  {
    var d = nodes[i];
    if (d[1] == url) 
    {
      return new Array(i);
    }
    else if (d[2] != null) // array of children
    {
      result = findNavTreePage(url, d[2]);
      if (result != null) 
      {
        return (new Array(i).concat(result));
      }
    }
  }
  return null;
}

function initNavTree(toroot,relpath)
{
  var o = new Object();
  o.toroot = toroot;
  o.node = new Object();
  o.node.li = document.getElementById("nav-tree-contents");
  o.node.childrenData = NAVTREE;
  o.node.children = new Array();
  o.node.childrenUL = document.createElement("ul");
  o.node.getChildrenUL = function() { return o.node.childrenUL; };
  o.node.li.appendChild(o.node.childrenUL);
  o.node.depth = 0;
  o.node.relpath = relpath;

  getNode(o, o.node);

  o.breadcrumbs = findNavTreePage(toroot, NAVTREE);
  if (o.breadcrumbs == null)
  {
    o.breadcrumbs = findNavTreePage("index.html",NAVTREE);
  }
  if (o.breadcrumbs != null && o.breadcrumbs.length>0)
  {
    var p = o.node;
    for (var i in o.breadcrumbs) 
    {
      var j = o.breadcrumbs[i];
      p = p.children[j];
      expandNode(o,p,true);
    }
    p.itemDiv.className = p.itemDiv.className + " selected";
    p.itemDiv.id = "selected";
    $(window).load(showRoot);
  }
}

