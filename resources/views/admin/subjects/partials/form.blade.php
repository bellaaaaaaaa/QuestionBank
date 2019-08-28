<div class="form-group has-label">
  <label>Subject
    <star class="star">*</star>
  </label>
  {{ Form::text('name', null, [ 'class'=>'form-control', 'required']) }}

  <label>Teacher
    <star class="star">*</star>
  </label>
  {{ Form::select('teacher_id', $teachers, null, array('class' => 'form-control', 'required')) }}

  <label>Description
    <star class="star">*</star>
  </label>
  {{ Form::textarea('description', null, [ 'class'=>'form-control', 'required']) }}

  <label>1 month price (MYR)
    <star class="star">*</star>
  </label>
  {{ Form::text('one_month_price', null, [ 'class'=>'form-control', 'required']) }}

  <label>2 month price (MYR)
    <star class="star">*</star>
  </label>
  {{ Form::text('two_month_price', null, [ 'class'=>'form-control', 'required']) }}

  <label>3 month price (MYR)
    <star class="star">*</star>
  </label>
  {{ Form::text('three_month_price', null, [ 'class'=>'form-control', 'required']) }}
</div>

<div class="card-category form-category">
  <star class="star">*</star> Required fields
</div>