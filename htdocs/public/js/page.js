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
});
