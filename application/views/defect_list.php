<style>
    @media (max-width: 768px){
        .form-group{
            width: 80%;
        }
    }
    </style>
<div class="content container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                <div class="card-body p-20 text-center">
                     <form novalidate action="#"  method="post">
  <fieldset>
                    <h2>New Defect List</h2><br><br>
                    <h4><u>Which Job?</u></h4>
                    <div class="form-group">
                    <input type="text" placeholder="Enter Job Address or Lot/Tract Here" class="form-control-sm" style="width: 35%;"><br><br>
                    </div>
                    <button class="btn btn-primary">&nbsp;Start&nbsp;</button>
                    <br><br>
                    <h3>-- or --</h3><br><br>
                    <div class="form-group">
                     <select class="form-control-sm" style="width: 35%;">
                                    <option> Select by tract</option>
                                    <option>Admin</option>
                                    <option>Normal user</option>
                                    <option>Read only user</option>
                     </select><br><br>
                    </div>
                    <div class="form-group">
                     <select class="form-control-sm" style="width: 35%;">
                                    <option> Select by lot</option>
                                    <option>Admin</option>
                                    <option>Normal user</option>
                                    <option>Read only user</option>
                     </select><br><br><br>
                    </div>
                     <input type="button" name="password" class="btn btn-primary" style="float: right;" value="Next" />
  </fieldset>
                         <fieldset>
                             
                         </fieldset>
                     </form>
                </div>
                
            </div>
        </div>
    </div>
</div>