<?php

//Chart Create By kimniyom
class Highcharts {

    public $id;
    public $title;
    public $subtitle;
    public $categories;
    public $yAxis;
    public $series_name;
    public $series_spline_name;
    public $column_value;
    public $spline_value;
    public $type_chart = "column";
    public $color;
    function set_id($id = null) {
        $this->id = $id;
    }

    function set_title($title = null) {
        $this->title = $title;
    }

    function set_subtitle($text = null) {
        $this->subtitle = $text;
    }

    function set_categories($categories) {
        $this->categories = $categories;
    }

    function set_yAxis($yAxis = null) {
        $this->yAxis = $yAxis;
    }

    function set_series_name($series_name = null) {
        $this->series_name = $series_name;
    }

    function set_series_spline_name($series_name = null) {
        $this->series_spline_name = $series_name;
    }

    function set_value($value = null) {
        $this->column_value = $value;
    }

    function set_value_spline($value = null) {
        $this->spline_value = $value;
    }

    function set_type($type = null) {
        $this->type_chart = $type;
    }
    
    function set_color($color = null){
        $this->color= $color;
    }
    function Bar_and_spline($id = null, $title = null, $subtitle = null, $categories = null, $yAxis = null, $column_name = null, $spline_name = null, $column_value = null, $spline_value = null) {
        $str = "<script>
                    $(function () {
                        $('#$id').highcharts({
                            chart: {
                                //type: 'column'
                            },
                            credits: {
                                enabled: false
                            },
                            title: {
                                text: '$title'
                            },
                            subtitle: {
                                text: '$subtitle'
                            },
                            xAxis: {
                                categories: ['" . $categories . "'],
                                crosshair: true
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '$yAxis'
                                }
                            },
                            tooltip: {
                                headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                                pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                        '<td style=\"padding:0\"><b>{point.y}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                },
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: false
                                    }
                                }
                            },
                            series: [{
                                    type: 'column',
                                    colorByPoint: true,
                                    name: '$column_name',
                                    data: [$column_value]

                                }, {
                                    type: 'spline',
                                    name: '$spline_name',
                                    data: [$spline_value],
                                    marker: {
                                        lineWidth: 2,
                                        lineColor: 'red',
                                        fillColor: 'white'
                                    }
                                }]
                        });
                    });
                </script>";

        return $str;
    }

    function Bar_chart() {
        $str = "<script>
                    $(function () {
                        $('#$this->id').highcharts({
                            chart: {
                                type: '$this->type_chart'
                            },
                            title: {
                                text: '$this->title'
                            },
                            subtitle: {
                                text: '$this->subtitle'
                            },
                            xAxis: {
                                categories: ['" . $this->categories . "'],
                                crosshair: true
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: '$this->yAxis'
                                }
                            },
                            credits: {
                                enabled: false
                            },
                            tooltip: {
                                headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
                                pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                                        '<td style=\"padding:0\"><b>{point.y}</b></td></tr>',
                                footerFormat: '</table>',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                },
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            series: [{
                                    colorByPoint: true,
                                    name: '$this->series_name',
                                    data: [$this->column_value]

                                }]
                        });
                    });
                </script>";

        return $str;
    }

    function chart_spline() {
        $str = "<script> 
            $(function () {
                        $('#$this->id').highcharts({
                            chart: {
                                type: 'spline'
                            },
                            title: {
                                text: '$this->title'
                            },
                            subtitle: {
                                text: '$this->subtitle'
                            },
                            credits: {
                                enabled: false
                            },
                            xAxis: {
                                categories: ['" . $this->categories . "']
                            },
                            yAxis: {
                                title: {
                                    text: '$this->yAxis'
                                },
                                labels: {
                                    formatter: function () {
                                        return this.value;
                                    }
                                }
                            },
                            tooltip: {
                                crosshairs: true,
                                shared: true
                            },
                            plotOptions: {
                                spline: {
                                    marker: {
                                        radius: 4,
                                        lineColor: '#666666',
                                        lineWidth: 1
                                    }
                                },
                                series: {
                                    color: '$this->color',
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true
                                    }
                                }
                            },
                            series: [{
                                name: '$this->series_name',
                                data: [$this->column_value]
                            }]
                        });
                    });
                </script>";
        return $str;
    }

}
