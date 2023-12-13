!(function (u) {
 var n = {
  treshold: 4,
  maximumItems: 5,
  highlightTyped: !0,
  highlightClass: "text-primary",
 };
 function p(e, t, o) {
  var a;
  if (o.highlightTyped) {
   var n = t.label.toLowerCase().indexOf(e.toLowerCase());
   a =
    t.label.substring(0, n) +
    '<span class="' +
    (function (e) {
     if ("string" == typeof e) return e;
     if (0 == e.length) return "";
     for (var t = "", o = 0, a = e; o < a.length; o++) {
      var n = a[o];
      t += n + " ";
     }
     return t.substring(0, t.length - 1);
    })(o.highlightClass) +
    '">' +
    t.label.substring(n, n + e.length) +
    "</span>" +
    t.label.substring(n + e.length, t.label.length);
  } else a = t.label;
  return (
   '<button type="button" class="dropdown-item" data-value="' +
   t.value +
   '">' +
   a +
   "</button>"
  );
 }
 function l(e, t) {
  var o = e.val();
  if (o.length < t.treshold) return e.dropdown("hide"), 0;
  var a = e.next();
  a.html("");
  for (var n = 0, l = Object.keys(t.source), r = 0; r < l.length; r++) {
   var d = l[r],
    s = t.source[d],
    i = { label: t.label ? s[t.label] : d, value: t.value ? s[t.value] : s };
   if (
    0 <= i.label.toLowerCase().indexOf(o.toLowerCase()) &&
    (a.append(p(o, i, t)), 0 < t.maximumItems && ++n >= t.maximumItems)
   )
    break;
  }
  return (
   e
    .next()
    .find(".dropdown-item")
    .click(function () {
     e.val(u(this).text()),
      t.onSelectItem &&
       t.onSelectItem(
        { value: u(this).data("value"), label: u(this).text() },
        e[0]
       );
    }),
   a.children().length
  );
 }
 u.fn.autocomplete = function (e) {
  var t = {};
  u.extend(t, n, e);
  var o = u(this);
  o.parent().removeClass("dropdown"),
   o.removeAttr("data-toggle"),
   o.removeClass("dropdown-toggle"),
   o.parent().find(".dropdown-menu").remove(),
   o.dropdown("dispose"),
   o.parent().addClass("dropdown"),
   o.attr("data-toggle", "dropdown"),
   o.addClass("dropdown-toggle");
  var a = u('<div class="dropdown-menu" ></div>');
  return (
   t.dropdownClass && a.addClass(t.dropdownClass),
   o.after(a),
   o.dropdown(t.dropdownOptions),
   this.off("click.autocomplete").click("click.autocomplete", function (e) {
    0 == l(o, t) && (e.stopPropagation(), o.dropdown("hide"));
   }),
   this.off("keyup.autocomplete").keyup("keyup.autocomplete", function () {
    0 < l(o, t) ? o.dropdown("show") : o.click();
   }),
   this
  );
 };
})(jQuery);
