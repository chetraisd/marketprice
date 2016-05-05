
<form id="demo-form" data-parsley-validate>
  <!-- this field is just required, it would be validated on form submit -->
 <div class="form-group">
 	<label for="fullname">Full Name * :</label>
  	<input type="text" class="form-control" name="fullname" required />
 </div>
  
  <!-- this required field must be an email, and validation will be run on
  field change -->
  <div class="form-group">
  <label for="email">Email * :</label>
  <input type="email" name="email" class="form-control" data-parsley-trigger="change" required />
	</div>
  <!-- radio and checkbox inputs by default have to be wrapped in a parent
  elemnt (here <p>) that will have success and error classes -->
  <div class="form-group">
  <label for="gender">Gender *:</label>
  <p>
    M: <input type="radio" name="gender" id="genderM" value="M" required />
    F: <input type="radio" name="gender" id="genderF" value="F" />
  </p>
	</div>
  <!-- here, field is not required, it won't throw any error if no checkbox
  is checked. But if checked, two at least must be checked -->
  <div class="form-group">
  <label for="hobbies">Hobbies (2 minimum):</label>
  <p>
    Skiing <input type="checkbox" name="hobbies" value="ski" data-parsley-mincheck="2"/>
    Running <input type="checkbox" name="hobbies" value="run" />
    Eating <input type="checkbox" name="hobbies" value="eat" />
    Sleeping <input type="checkbox" name="hobbies" value="sleep" />
    Reading <input type="checkbox" name="hobbies" value="read" />
    Coding <input type="checkbox" name="hobbies" value="code" />
  <p>
</div>

  <!-- regular select input. Nothing more to add. -->
  <label for="heard">Heard us by *:</label>
  <select id="heard" required>
    <option value="">Choose..</option>
    <option value="press">Press</option>
    <option value="net">Internet</option>
    <option value="mouth">Word of mouth</option>
    <option value="other">Other..</option>
  </select>

  <!-- this optional textarea have a length validator that would be checked on keyup after 10 first characters, with a custom message only for minlength validator -->
  <label for="message">Message (20 chars min, 100 max) :</label>
  <textarea class="form-control"  name="message" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-validation-threshold="10" data-parsley-minlength-message = "Come on! You need to enter at least a 20 caracters long comment.." ></textarea>

  <input type="submit" value="Save" class="btn btn-primary"/>
</form>

<script type="text/javascript">
  $('#demo-form').parsley();
</script>