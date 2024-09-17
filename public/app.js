import"./build/assets/flatpickr-a4e39586-v4.2.2.js";
import"./build/assets/mousetrap-87e41666-v4.2.2.js";
import{N as c}from "./build/assets/nprogress-8d484eeb-v4.2.2.js";
import"./build/assets/datatables.net-bs-a9600cc8-v4.2.2.js";
import{D as d}from "./build/assets/datatables.net-bea8d024-v4.2.2.js";
import{t as h,k as p,n as f,i as m,s as g,w as b,e as w}from "./build/assets/functions-ef5266fd-v4.2.2.js";
import"./build/assets/blueimp-md5-cee56f87-v4.2.2.js";import"./build/assets/jquery-9ef1a719-v4.2.2.js";
$.FleetCart={};$.FleetCart.options={animationSpeed:300,sidebarToggleSelector:"[data-toggle='offcanvas']",sidebarPushMenu:!0,enableBoxRefresh:!0,enableBSToppltip:!0,BSTooltipSelector:"[data-toggle='tooltip']",enableControlTreeView:!0,screenSizes:{xs:480,sm:768,md:992,lg:1200}};$(function(){var o=$.FleetCart.options;v(),$.FleetCart.layout.activate(),o.enableControlTreeView&&$.FleetCart.tree(".sidebar"),o.sidebarPushMenu&&$.FleetCart.pushMenu.activate(o.sidebarToggleSelector),o.enableBSToppltip&&$("body").tooltip({selector:o.BSTooltipSelector,container:"body"})});function v(){$.FleetCart.layout={activate:function(){var o=this;o.fix(),$(window,".wrapper").resize(function(){o.fix()})},fix:function(){var o=$(window).height();$(".wrapper").css("min-height",o+"px")}},$.FleetCart.pushMenu={activate:function(o){var e=$.FleetCart.options.screenSizes;$(document).on("click",o,function(t){if(t.preventDefault(),$(window).outerWidth()>e.md-1){if($("body").hasClass("sidebar-collapse")){$("body").removeClass("sidebar-collapse").trigger("expanded.pushMenu");return}$("body").addClass("sidebar-collapse").trigger("collapsed.pushMenu");return}if($("body").hasClass("sidebar-open")){$("body").removeClass("sidebar-open").removeClass("sidebar-collapse").trigger("collapsed.pushMenu");return}$("body").addClass("sidebar-open").trigger("expanded.pushMenu")}),$(window).on("resize",function(){$(window).outerWidth()>e.md-1||$("body").removeClass("sidebar-collapse")}),$(".content-wrapper").click(function(){$(window).width()<=e.md-1&&$("body").hasClass("sidebar-open")&&$("body").removeClass("sidebar-open")})}},$.FleetCart.tree=function(o){var e=$.FleetCart.options.animationSpeed;$(document).off("click",o+" li a").on("click",o+" li a",function(t){var a=$(this),r=a.next(),s=a.closest(".sidebar-menu").find(".active");r.is(".treeview-menu")&&(a.closest(".sidebar-menu").find(".selected").removeClass("selected"),t.preventDefault()),a.parent().is(".active")?s.toggleClass("closed"):s.addClass("closed"),r.is(".treeview-menu")&&r.is(":visible")&&!$("body").hasClass("sidebar-collapse")?(a.parent().removeClass("selected"),r.slideUp(e)):r.is(".treeview-menu")&&!r.is(":visible")&&(a.parents("ul").first().find("ul:visible").slideUp(e),a.parent().addClass("selected"),r.slideDown(e))})}}(function(o){o.fn.boxRefresh=function(e){var t=o.extend({trigger:".refresh-btn",source:"",onLoadStart:function(n){return n},onLoadDone:function(n){return n}},e),a=o('<div class="overlay"><div class="fa fa-refresh fa-spin"></div></div>');return this.each(function(){if(t.source===""){window.console&&window.console.log("Please specify a source first - boxRefresh()");return}var n=o(this),i=n.find(t.trigger).first();i.on("click",function(l){l.preventDefault(),r(n),n.find(".box-body").load(t.source,function(){s(n)})})});function r(n){n.append(a),t.onLoadStart.call(n)}function s(n){n.find(a).remove(),t.onLoadDone.call(n)}}})(jQuery);(function(o,e,t,a){let r="keypressAction",s={};function n(i,l){this.element=i,this.settings=o.extend({},s,l),this._defaults=s,this._name=r,this.init()}o.extend(n.prototype,{bindKeyToRoute(i,l){Mousetrap.bind([i],y=>(e.location=l,!1))},init(){o.each(this.settings.actions,(i,l)=>{this.bindKeyToRoute(l.key,l.route)})}}),o.fn[r]=function(i){return this.each(function(){o.data(this,`plugin_${r}`)||o.data(this,`plugin_${r}`,new n(this,i))}),this}})(jQuery,window);class C{constructor(){this.selectize(),this.dateTimePicker(),this.changeAccordionTabState(),this.preventChangingCurrentTab(),this.buttonLoading(),this.confirmationModal(),this.tooltip(),this.shortcuts(),this.nprogress(),this.setActiveAccordionTabQueryParam(),this.setDefaultActiveAccordionTabQueryParam(),this.stopDropdownPropagation(),this.fullscreenMode()}fullscreenMode(){$(".fullscreen-mode-open").on("click",e=>{e.preventDefault(),document.fullscreenElement?($(".fullscreen-mode-open .fullscreen-two").removeClass("enter-full-screen"),$(".fullscreen-mode-open .fullscreen-one").addClass("exit-full-screen"),document.exitFullscreen().catch(t=>{alert(`Error attempting to disable full-screen mode: ${t.message} (${t.name})`)})):($(".fullscreen-mode-open .fullscreen-one").removeClass("exit-full-screen"),$(".fullscreen-mode-open .fullscreen-two").addClass("enter-full-screen"),document.documentElement.requestFullscreen().catch(t=>{alert(`Error attempting to enable full-screen mode: ${t.message} (${t.name})`)}))})}stopDropdownPropagation(){$(".dropdown-menu").on("click",e=>{e.stopPropagation()})}selectize(){let e=$("select.selectize").removeClass("form-control custom-select-black"),t=_.merge({valueField:"id",labelField:"name",searchField:"name",delimiter:",",persist:!0,selectOnTab:!0,hideSelected:!0,allowEmptyOption:!0,onItemAdd(a){this.getItem(a)[0].innerHTML=this.getItem(a)[0].innerHTML.replace(/¦––\s/g,"")},onInitialize(){for(let a in this.options){let r=this.options[a].name,s=this.options[a].id;this.$control.find(`.item[data-value="${s}"]`).html(r.replace(/¦––\s/g,"")+'<a href="javascript:void(0)" class="remove" tabindex="-1">×</a>')}}},...FleetCart.selectize);for(let a of e){a=$(a);let r=!0,s=["remove_button","restore_on_backspace"];a.hasClass("prevent-creation")&&(r=!1,s.remove("restore_on_backspace")),a.selectize(_.merge(t,{create:r,plugins:s}))}}dateTimePicker(e){e=e||$(".datetime-picker"),e=e instanceof jQuery?e:$(e);for(let t of e)$(t).flatpickr({mode:t.hasAttribute("data-range")?"range":"single",enableTime:t.hasAttribute("data-time"),noCalender:t.hasAttribute("data-no-calender"),altInput:!0})}changeAccordionTabState(){$('.accordion-box [data-toggle="tab"]').on("click",e=>{$(e.currentTarget).parent().hasClass("active")||$(".accordion-tab li.active").removeClass("active")})}preventChangingCurrentTab(){$('[data-toggle="tab"]').on("click",e=>{if($(e.currentTarget).parent().hasClass("active"))return!1})}removeSubmitButtonOffsetOn(e,t=null){e=Array.isArray(e)?e:[e],$(t||".accordion-tab li > a").on("click",a=>{e.includes(a.currentTarget.getAttribute("href"))?setTimeout(()=>{$("button[type=submit]").parent().removeClass("col-md-offset-2")},150):setTimeout(()=>{$("button[type=submit]").parent().addClass("col-md-offset-2")},150)})}buttonLoading(){$(document).on("click","[data-loading]",e=>{let t=$(e.currentTarget);t.data("loading-text",t.html()).addClass("btn-loading").button("loading")})}stopButtonLoading(e){e=e instanceof jQuery?e:$(e),e.data("loading-text",e.html()).removeClass("btn-loading").button("reset")}confirmationModal(){let e=$("#confirmation-modal");$("[data-confirm]").on("click",()=>{e.modal("show")}),e.find("form").on("submit",()=>{e.find("button.delete").prop("disabled",!0)}),e.on("hidden.bs.modal",()=>{e.find("button.delete").prop("disabled",!1)}),e.on("shown.bs.modal",()=>{e.find("button.delete").focus()})}tooltip(){$('[data-toggle="tooltip"]').tooltip({trigger:"hover"}).on("click",e=>{$(e.currentTarget).tooltip("hide")})}shortcuts(){Mousetrap.bind("f1",()=>{window.open("https://docs.envaysoft.com/","_blank")}),Mousetrap.bind("?",()=>{$("#keyboard-shortcuts-modal").modal()})}nprogress(){c.configure({showSpinner:!1}),$(document).ajaxStart(()=>c.start()),$(document).ajaxComplete(()=>c.done())}setActiveAccordionTabQueryParam(){$('.accordion-box a[data-toggle="tab"]').on("click",e=>{const t=$(e.currentTarget),a=t.closest("form"),r=`?tab=${t.attr("href").slice(1)}`;a.attr("action",`${a.attr("action").split("?")[0]}${r}`),history.replaceState(null,null,`${window.location.pathname}${r}`)})}setDefaultActiveAccordionTabQueryParam(){const e=$(".accordion-tab li.active a");if(e.length!==0){const t=e.closest("form"),a=`?tab=${e.attr("href").slice(1)}`;t.attr("action",`${t.attr("action")}${a}`),history.replaceState(null,null,`${window.location.pathname}${a}`)}}}class k{appendHiddenInput(e,t,a){$("<input>").attr({type:"hidden",name:t,value:a}).appendTo(e)}appendHiddenInputs(e,t,a){for(let r of a)this.appendHiddenInput(e,t+"[]",r)}removeErrors(){$(".has-error > .help-block").remove(),$(".has-error").removeClass("has-error")}}FleetCart.dataTable={routes:{},selected:{}};let u=null;class T{constructor(e,t,a){this.selector=e,this.element=$(e),FleetCart.dataTable.selected[e]===void 0&&(FleetCart.dataTable.selected[e]=[]),this.initiateDataTable(t,a),this.addErrorHandler(),this.registerTableProcessingPlugin()}initiateDataTable(e,t){let a=this.element.find("th[data-sort]");u=new d(this.element,_.merge({serverSide:!0,processing:!0,ajax:this.route("table",{table:!0}),stateSave:!0,sort:!0,info:!0,filter:!0,lengthChange:!0,paginate:!0,autoWidth:!1,pageLength:20,lengthMenu:[10,20,50,100,200],order:[a.index()!==-1?a.index():1,a.data("sort")||"desc"],layout:{topEnd:{search:{placeholder:trans("admin::admin.table.search_here")}}},initComplete:()=>{this.hasRoute("destroy")&&(this.addTableActions().on("click",()=>this.deleteRows()),this.selectAllRowsEventListener()),(this.hasRoute("show")||this.hasRoute("edit"))&&this.onRowClick(this.redirectToRowPage),t!==void 0&&t.call(this)},rowCallback:(r,s)=>{(this.hasRoute("show")||this.hasRoute("edit"))&&this.makeRowClickable(r,s.id)},drawCallback:()=>{this.element.find(".select-all").prop("checked",!1),setTimeout(()=>{this.selectRowEventListener(),this.checkSelectedCheckboxes(this.constructor.getSelectedIds(this.selector))})},stateSaveParams(r,s){delete s.search}},e))}addTableActions(){let e=`
            <button type="button" class="btn btn-default btn-delete">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16" fill="none">
                    <path d="M12 3.6665L11.5868 10.3499C11.4813 12.0575 11.4285 12.9113 11.0005 13.5251C10.7889 13.8286 10.5164 14.0847 10.2005 14.2772C9.56141 14.6665 8.70599 14.6665 6.99516 14.6665C5.28208 14.6665 4.42554 14.6665 3.78604 14.2765C3.46987 14.0836 3.19733 13.827 2.98579 13.5231C2.55792 12.9082 2.5063 12.0532 2.40307 10.3433L2 3.6665" stroke="#141B34" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M5 7.82324H9" stroke="#141B34" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M6 10.436H8" stroke="#141B34" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M1 3.66659H13M9.70369 3.66659L9.24858 2.72774C8.94626 2.10409 8.7951 1.79227 8.53435 1.59779C8.47651 1.55465 8.41527 1.51628 8.35122 1.48305C8.06248 1.33325 7.71595 1.33325 7.02289 1.33325C6.31243 1.33325 5.95719 1.33325 5.66366 1.48933C5.59861 1.52392 5.53653 1.56385 5.47807 1.6087C5.2143 1.81105 5.06696 2.13429 4.77228 2.78076L4.36849 3.66659" stroke="#020010" stroke-width="1.5" stroke-linecap="round"/>
                </svg>

                <span>${trans("admin::admin.buttons.delete")}</span>
            </button>
        `;return $(e).appendTo(this.element.closest(".dt-container").find(".dt-length"))}deleteRows(){let e=this.element.find(".select-row:checked");if(e.length===0)return;let t=$("#confirmation-modal"),a=[];t.modal("show").find("form").on("submit",r=>{r.preventDefault(),t.modal("hide");let s=this.constructor.getRowIds(e);a.length!==0&&_.difference(a,s).length===0||$.ajax({type:"DELETE",url:this.route("destroy",{ids:s.join()}),success:()=>{a=_.flatten(a.concat(s)),this.constructor.setSelectedIds(this.selector,[]),this.constructor.reload(this.element)},error:n=>{error(n.responseJSON.message),a=_.flatten(a.concat(s)),this.constructor.setSelectedIds(this.selector,[]),this.constructor.reload(this.element)}})})}makeRowClickable(e,t){let a=this.hasRoute("show")?"show":"edit",r=this.route(a,{id:t});$(e).addClass("clickable-row").data("href",r)}onRowClick(e){let t="tbody tr.clickable-row td";this.element.find(".select-all").length!==0&&(t+=":not(:first-child)"),this.element.on("click",t,e)}redirectToRowPage(e){window.open($(e.currentTarget).parent().data("href"),e.ctrlKey?"_blank":"_self")}selectAllRowsEventListener(){this.element.find(".select-all").on("change",e=>{this.element.find(".select-row").prop("checked",e.currentTarget.checked),e.currentTarget.checked?this.element.find(".clickable-row").addClass("active"):this.element.find(".clickable-row").removeClass("active")})}selectRowEventListener(){this.element.find(".select-row").on("change",e=>{e.currentTarget.checked?(this.appendToSelected(e.currentTarget.value),$(e.currentTarget).parents(".clickable-row").addClass("active")):(this.removeFromSelected(e.currentTarget.value),$(e.currentTarget).parents(".clickable-row").removeClass("active"))})}appendToSelected(e){e=parseInt(e),FleetCart.dataTable.selected[this.selector].includes(e)||FleetCart.dataTable.selected[this.selector].push(e)}removeFromSelected(e){e=parseInt(e),FleetCart.dataTable.selected[this.selector].remove(e)}checkSelectedCheckboxes(e){let a=this.element.find(".select-row").toArray().filter(r=>e.includes(parseInt(r.value)));$(a).prop("checked",!0)}route(e,t){let a=FleetCart.dataTable.routes[this.selector][e];return typeof a=="string"&&(a={name:a,params:t}),a.params=_.merge(t,a.params),window.route(a.name,a.params)}hasRoute(e){return FleetCart.dataTable.routes[this.selector][e]!==void 0}static setRoutes(e,t){FleetCart.dataTable.routes[e]=t}static setSelectedIds(e,t){FleetCart.dataTable.selected[e]=t}static getSelectedIds(e){return FleetCart.dataTable.selected[e]}static reload(e,t,a=!1){u.ajax.reload(t,a)}static getRowIds(e){return e.toArray().reduce((t,a)=>t.concat(a.value),[])}static removeLengthFields(){$(".dt-length select").remove()}addErrorHandler(){d.ext.errMode=(e,t,a)=>{this.element.html(a)}}registerTableProcessingPlugin(){d.Api.register("processing()",function(e){return this.iterator("table",function(t){t.oApi._fnProcessingDisplay(t,e)})})}}!route().current("admin.products.create")&&!route().current("admin.products.edit")&&!route().current("admin.blog_posts.create")&&!route().current("admin.blog_posts.edit")&&(window.admin=new C);window.form=new k;window.DataTable=T;window.trans=h;window.keypressAction=p;window.notify=f;window.info=m;window.success=g;window.warning=b;window.error=w;$.ajaxSetup({headers:{Authorization:FleetCart.apiToken,"X-CSRF-TOKEN":FleetCart.csrfToken}});
