<?
include( '../php-ofc-library/open-flash-chart.php' );
$koneksi=mysql_connect("localhost","root","123456");
mysql_select_db("exercises",$koneksi);

$sql=mysql_query("select count(*) as total, nama from polling group by nama");

$pie = new pie();
$pie->alpha(0.5)
    ->add_animation( new pie_fade() )
    ->add_animation( new pie_bounce(5) )
    //->start_angle( 270 )
    ->start_angle( 0 )
    ->tooltip( '#label#<br>#val# of #total#<br>#percent# of 100%' )
	->gradient_fill()
    ->colours(array('#FF0000','#00FF00','#0000FF','#000000','#00FFFF','#FF00FF'));

while($row = mysql_fetch_array($sql))
{
	$d[] = new pie_value( intval($row["total"]),$row["nama"] );
}

$pie->set_values( $d );

$chart = new open_flash_chart();
//$chart->set_title( $title );
$chart->add_element( $pie );

echo $chart->toPrettyString();
?>
