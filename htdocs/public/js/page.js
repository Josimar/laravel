$(document).ready(function () {
    "use strict";
    var l = {
            chart: {
                type: "line",
                width: 80,
                height: 35,
                sparkline: {
                    enabled: !0
                }
            },
            series: [],
            stroke: {
                width: 2,
                curve: "smooth"
            },
            markers: {
                size: 0
            },
            colors: ["#727cf5"],
            tooltip: {
                fixed: {
                    enabled: !1
                },
                x: {
                    show: !1
                },
                y: {
                    title: {
                        formatter: function (e) {
                            return ""
                        }
                    }
                },
                marker: {
                    show: !1
                }
            }
        },
        s = [];
    $("#usuarios-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'custom-select custom-select-sm ml-1 mr-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="-1">All</option></select>'
        },
        pageLength: 10,
        columns: [{
            orderable: !1,
            render: function (e, t, o, l) {
                return "display" === t && (e = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'),
                    e
            },
            checkboxes: {
                selectRow: !0,
                selectAllRender: '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'
            }
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !1
        }
        ],
        select: {
            style: "multi"
        },
        order: [[4, "desc"]],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            for (var e = 0; e < s.length; e++)
                try {
                    s[e].destroy()
                } catch (e) {
                    console.log(e)
                }
            s = [],
                $(".spark-chart").each(function (e) {
                    var t = $(this).data().dataset;
                    l.series = [{
                        data: t
                    }
                    ];
                    var o = new ApexCharts($(this)[0], l);
                    s.push(o),
                        o.render()
                })
        }
    })

    $("#sistemas-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'custom-select custom-select-sm ml-1 mr-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="-1">All</option></select>'
        },
        pageLength: 10,
        columns: [{
            orderable: !1,
            render: function (e, t, o, l) {
                return "display" === t && (e = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'),
                    e
            },
            checkboxes: {
                selectRow: !0,
                selectAllRender: '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'
            }
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !1
        }
        ],
        select: {
            style: "multi"
        },
        order: [[4, "desc"]],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            for (var e = 0; e < s.length; e++)
                try {
                    s[e].destroy()
                } catch (e) {
                    console.log(e)
                }
            s = [],
                $(".spark-chart").each(function (e) {
                    var t = $(this).data().dataset;
                    l.series = [{
                        data: t
                    }
                    ];
                    var o = new ApexCharts($(this)[0], l);
                    s.push(o),
                        o.render()
                })
        }
    })

    $("#listas-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'custom-select custom-select-sm ml-1 mr-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="-1">All</option></select>'
        },
        pageLength: 10,
        columns: [{
            orderable: !1,
            render: function (e, t, o, l) {
                return "display" === t && (e = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'),
                    e
            },
            checkboxes: {
                selectRow: !0,
                selectAllRender: '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'
            }
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !1
        }
        ],
        select: {
            style: "multi"
        },
        order: [[4, "desc"]],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            for (var e = 0; e < s.length; e++)
                try {
                    s[e].destroy()
                } catch (e) {
                    console.log(e)
                }
            s = [],
                $(".spark-chart").each(function (e) {
                    var t = $(this).data().dataset;
                    l.series = [{
                        data: t
                    }
                    ];
                    var o = new ApexCharts($(this)[0], l);
                    s.push(o),
                        o.render()
                })
        }
    })

    $("#produtos-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'custom-select custom-select-sm ml-1 mr-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="-1">All</option></select>'
        },
        pageLength: 10,
        columns: [{
            orderable: !1,
            render: function (e, t, o, l) {
                return "display" === t && (e = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'),
                    e
            },
            checkboxes: {
                selectRow: !0,
                selectAllRender: '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'
            }
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !1
        }
        ],
        select: {
            style: "multi"
        },
        order: [[4, "desc"]],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            for (var e = 0; e < s.length; e++)
                try {
                    s[e].destroy()
                } catch (e) {
                    console.log(e)
                }
            s = [],
                $(".spark-chart").each(function (e) {
                    var t = $(this).data().dataset;
                    l.series = [{
                        data: t
                    }
                    ];
                    var o = new ApexCharts($(this)[0], l);
                    s.push(o),
                        o.render()
                })
        }
    })

    $("#tarefas-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'custom-select custom-select-sm ml-1 mr-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="-1">All</option></select>'
        },
        pageLength: 10,
        columns: [{
            orderable: !1,
            render: function (e, t, o, l) {
                return "display" === t && (e = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'),
                    e
            },
            checkboxes: {
                selectRow: !0,
                selectAllRender: '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'
            }
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !1
        }
        ],
        select: {
            style: "multi"
        },
        order: [[4, "desc"]],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            for (var e = 0; e < s.length; e++)
                try {
                    s[e].destroy()
                } catch (e) {
                    console.log(e)
                }
            s = [],
                $(".spark-chart").each(function (e) {
                    var t = $(this).data().dataset;
                    l.series = [{
                        data: t
                    }
                    ];
                    var o = new ApexCharts($(this)[0], l);
                    s.push(o),
                        o.render()
                })
        }
    })

    $("#tarefas-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'custom-select custom-select-sm ml-1 mr-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="-1">All</option></select>'
        },
        pageLength: 10,
        columns: [{
            orderable: !1,
            render: function (e, t, o, l) {
                return "display" === t && (e = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'),
                    e
            },
            checkboxes: {
                selectRow: !0,
                selectAllRender: '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'
            }
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !1
        }
        ],
        select: {
            style: "multi"
        },
        order: [[4, "desc"]],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            for (var e = 0; e < s.length; e++)
                try {
                    s[e].destroy()
                } catch (e) {
                    console.log(e)
                }
            s = [],
                $(".spark-chart").each(function (e) {
                    var t = $(this).data().dataset;
                    l.series = [{
                        data: t
                    }
                    ];
                    var o = new ApexCharts($(this)[0], l);
                    s.push(o),
                        o.render()
                })
        }
    })

    $("#categorias-datatable").DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'custom-select custom-select-sm ml-1 mr-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="50">50</option><option value="-1">All</option></select>'
        },
        pageLength: 10,
        columns: [{
            orderable: !1,
            render: function (e, t, o, l) {
                return "display" === t && (e = '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'),
                    e
            },
            checkboxes: {
                selectRow: !0,
                selectAllRender: '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input dt-checkboxes"><label class="custom-control-label">&nbsp;</label></div>'
            }
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !0
        }, {
            orderable: !1
        }
        ],
        select: {
            style: "multi"
        },
        order: [[4, "desc"]],
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            for (var e = 0; e < s.length; e++)
                try {
                    s[e].destroy()
                } catch (e) {
                    console.log(e)
                }
            s = [],
                $(".spark-chart").each(function (e) {
                    var t = $(this).data().dataset;
                    l.series = [{
                        data: t
                    }
                    ];
                    var o = new ApexCharts($(this)[0], l);
                    s.push(o),
                        o.render()
                })
        }
    })

    $.fn.extend({
        treed: function (o) {

            var openedClass = 'glyphicon-minus-sign';
            var closedClass = 'glyphicon-plus-sign';

            if (typeof o != 'undefined'){
                if (typeof o.openedClass != 'undefined'){
                    openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined'){
                    closedClass = o.closedClass;
                }
            };

            /* initialize each of the top levels */
            var tree = $(this);
            tree.addClass("tree");
            tree.find('li').has("ul").each(function () {
                var branch = $(this);
                branch.prepend("");
                branch.addClass('branch');
                branch.on('click', function (e) {
                    if (this == e.target) {
                        var icon = $(this).children('i:first');
                        icon.toggleClass(openedClass + " " + closedClass);
                        $(this).children().children().toggle();
                    }
                })
                branch.children().children().toggle();
            });
            /* fire event from the dynamically added icon */
            tree.find('.branch .indicator').each(function(){
                $(this).on('click', function () {
                    $(this).closest('li').click();
                });
            });
            /* fire event to open branch if the li contains an anchor instead of text */
            tree.find('.branch>a').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
            /* fire event to open branch if the li contains a button instead of text */
            tree.find('.branch>button').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
        }
    });
    /* Initialization of treeviews */
    $('#treeCategoria').treed();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
        $('.categoriaid1').on('change',function(e) {
            var categoriaid = e.target.value;
            $.ajax({
                url: $('.categoriaid1').attr('style').split('#')[0],
                type:"GET",
                data: {
                    'conditions': 'categoriaid:=:' + categoriaid
                },
                success:function (data) {
                    $('.categoriaid2').empty();
                    $('.categoriaid3').empty();
                    $.each(data.data,function(index,subcategory){
                        $('.categoriaid2').append('<option value="'+subcategory.id+'">'+subcategory.descricao+'</option>');
                    })
                }
            })
        });
        $('.categoriaid2').on('change',function(e) {
            var categoriaid = e.target.value;
            $.ajax({
                url: $('.categoriaid2').attr('style').split('#')[0],
                type:"GET",
                data: {
                    'conditions': 'categoriaid:=:' + categoriaid
                },
                success:function (data) {
                    $('.categoriaid3').empty();
                    $.each(data.data,function(index,subcategory){
                        $('.categoriaid3').append('<option value="'+subcategory.id+'">'+subcategory.descricao+'</option>');
                    })
                }
            })
        });
        $('.categoriaid4').on('change',function(e) {
            const select = e.target;
            const value = select.value;
            const desc = select.options[select.selectedIndex].text;

            $('input#id.editid').val(value);
            $('input#descricao.editdescricao').val(desc);

            var categoriaid = e.target.value;
            $.ajax({
                url: $('.categoriaid4').attr('style').split('#')[0],
                type:"GET",
                data: {
                    'conditions': 'categoriaid:=:' + categoriaid
                },
                success:function (data) {
                    $('.categoriaid5').empty();
                    $('.categoriaid6').empty();
                    $.each(data.data,function(index,subcategory){
                        $('.categoriaid5').append('<option value="'+subcategory.id+'">'+subcategory.descricao+'</option>');
                    })
                }
            })
        });
        $('.categoriaid5').on('change',function(e) {
            const select = e.target;
            const value = select.value;
            const desc = select.options[select.selectedIndex].text;

            $('input#id.editid').val(value);
            $('input#descricao.editdescricao').val(desc);

            var categoriaid = e.target.value;
            $.ajax({
                url: $('.categoriaid5').attr('style').split('#')[0],
                type:"GET",
                data: {
                    'conditions': 'categoriaid:=:' + categoriaid
                },
                success:function (data) {
                    $('.categoriaid6').empty();
                    $.each(data.data,function(index,subcategory){
                        $('.categoriaid6').append('<option value="'+subcategory.id+'">'+subcategory.descricao+'</option>');
                    })
                }
            })
        });
        $('.categoriaid6').on('change',function(e) {
            const select = e.target;
            const value = select.value;
            const desc = select.options[select.selectedIndex].text;

            $('input#id.editid').val(value);
            $('input#descricao.editdescricao').val(desc);
        });
    });

    function apagarCategoria(id){
        if(confirm('Are you sure want to remove?')) {
            alert(id);
        }
    }

    $(document).ready(function() {
        $('#moverCategoria').click(function(){
            console.log($(this).attr("data-id"));
        });
        $('#apagarCategoria').click(function(){ apagarCategoria(1); return false; });
        $('.atualizarCategoria').click(function(e){
            e.preventDefault();
            let idn = $(this).attr("data-id");
            let id = $('input#id.editid').val();

            $('#categoriaid').val(id);
            $('#categoriaidpai').val(idn);
            $('#frmCategoria').submit();
        });
    });

});
