<p>Номер заказа` {{$details['order_id']}}</p>  <br>
<p>Ф.И.О` {{$details['name']}}</p>  <br>
<p>Телефон` {{$details['phone']}}</p>  <br>
<p>Эл.почта` {{$details['email']}}</p>  <br>
@if($details['promo_code'] != null)
<p>Промокод` {{$details['promo_code']}}</p>  <br>
@endif
<br>
 <a href="{{$details['url']}}">Ссылка на заказ</a>
