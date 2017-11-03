<form id="frmApplication" method="post" enctype="multipart/form-data">
    <div class="box box-primary accordian_step" id="step1">
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Enter Store Location:</label>
                    <input type="text" class="form-control" name="store_location" placeholder="Type in Dealer Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Storis Account Number:</label>
                    <input type="text" class="form-control" name="storis_number">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Sales Person Code</label>
                    <input type="text" class="form-control" name="sales_person">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">How did you hear about Star World?</label>
                    <select name="marketing_source_1"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="A-HOY MAGAZINE">A-HOY MAGAZINE</option>
                        <option value="CATALOG">CATALOG</option>
                        <option value="DISH OR DIRECT TV">DISH OR DIRECT TV</option>
                        <option value="FACEBOOK">FACEBOOK</option>
                        <option value="FRIEND OR FAMILY">FRIEND OR FAMILY</option>
                        <option value="INSTAGRAM">INSTAGRAM</option>
                        <option value="LOCAL NON-CABLE TV">LOCAL NON-CABLE TV</option>
                        <option value="NEWSPAPER">NEWSPAPER</option>
                        <option value="OTHER">OTHER</option>
                        <option value="RADIO">RADIO</option>
                        <option value="SOCIAL MEDIA">SOCIAL MEDIA</option>
                        <option value="TIME WARNER CABLE">TIME WARNER CABLE</option>
                        <option value="TV">TV</option>
                        <option value="TWITTER">TWITTER</option>
                        <option value="YELP">YELP</option>
                        <option value="PROMOTER">PROMOTER</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">How else did you hear about Star World?</label>
                    <select name="marketing_source_2"  class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        <option value="A-HOY MAGAZINE">A-HOY MAGAZINE</option>
                        <option value="CATALOG">CATALOG</option>
                        <option value="DISH OR DIRECT TV">DISH OR DIRECT TV</option>
                        <option value="FACEBOOK">FACEBOOK</option>
                        <option value="FRIEND OR FAMILY">FRIEND OR FAMILY</option>
                        <option value="INSTAGRAM">INSTAGRAM</option>
                        <option value="LOCAL NON-CABLE TV">LOCAL NON-CABLE TV</option>
                        <option value="NEWSPAPER">NEWSPAPER</option>
                        <option value="OTHER">OTHER</option>
                        <option value="RADIO">RADIO</option>
                        <option value="SOCIAL MEDIA">SOCIAL MEDIA</option>
                        <option value="TIME WARNER CABLE">TIME WARNER CABLE</option>
                        <option value="TV">TV</option>
                        <option value="TWITTER">TWITTER</option>
                        <option value="YELP">YELP</option>
                        <option value="PROMOTER">PROMOTER</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Preferred Language:</label>
                    <select name="preferred_language"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="English">English</option>
                        <option value="Spanish">Spanish</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Storis Account Number: RETAIL</label>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Application Type:</label>
                    <select name="application_type"  class="form-control select2" style="width: 100%;">

                        <option selected="selected" value="Individual">Individual</option>
                        <option value="Joint">Joint</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="clear: both;"></div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step2')">Next</button>
        </div>
    </div>

    <div class="box box-primary accordian_step" id="step2" style="display: none">
        <div class="box-header with-border">
            <h3 class="box-title"> Applicant Information </h3>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">First Name:</label>
                    <input type="text" class="form-control" name="firstname" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Middle Initial:</label>
                    <input type="text" class="form-control" name="middle_initial" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Last Name:</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Suffix:</label>
                    <input type="text" class="form-control" name="suffix" placeholder="Suffix">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email Address:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Consulate Id #:</label>
                    <input type="text" class="form-control" name="consulate_id" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Passport #:</label>
                    <input type="text" class="form-control" name="passport_number" placeholder="">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Social Security #:</label>
                    <input type="text" class="form-control" name="ssn" placeholder="XXX-XX-XXXX">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Date of Birth:</label>
                    <input type="text" class="form-control" name="dob" placeholder="MM/DD/YYYY">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Driver's License #:</label>
                    <input type="text" class="form-control" name="drivers_license" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">License State:</label>
                    <select name="license_state"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District of Col</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                        <option value="AS">American Samoa</option>
                        <option value="FM">Federated State</option>
                        <option value="GU">Guam</option>
                        <option value="MH">Marshall Island</option>
                        <option value="MP">Northern Marian</option>
                        <option value="PW">Palau</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="UM">U.S. Minor Outl</option>
                        <option value="VI">Virgin Islands</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Consulate Id Country</label>
                    <select name="consulate_id_country"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belize">Belize</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Chile">Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Panama">Panama</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="St Kitts &amp; Nevis">St Kitts &amp; Nevis</option>
                        <option value="St Lucia">St Lucia</option>
                        <option value="St Vincent &amp; the Grenadines">St Vincent &amp; the Grenadines</option>
                        <option value="Suriname">Suriname</option>
                        <option value="The Bahamas">The Bahamas</option>
                        <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="USA">USA</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Passport Country:</label>
                    <select name="passport_country"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belize">Belize</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Chile">Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Panama">Panama</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="St Kitts &amp; Nevis">St Kitts &amp; Nevis</option>
                        <option value="St Lucia">St Lucia</option>
                        <option value="St Vincent &amp; the Grenadines">St Vincent &amp; the Grenadines</option>
                        <option value="Suriname">Suriname</option>
                        <option value="The Bahamas">The Bahamas</option>
                        <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="USA">USA</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="clear: both;"></div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step3')">Next</button>
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step1')" style="margin-right: 10px;">Previous</button>
        </div>

    </div>


    <div class="box box-primary accordian_step" id="step3" style="display: none">
        <div class="box-header with-border">
            <h3 class="box-title"> Applicant Additional Info </h3>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Number of Dependents</label>
                    <input type="text" class="form-control" name="number_of_dependents" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Gender</label>
                    <select name="gender"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Female">Female</option>
                        <option value="Male">Male</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Marital Status</label>
                    <select name="marital_status"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Married">Married</option>
                        <option value="Partnered">Partnered</option>
                        <option value="Separated">Separated</option>
                        <option value="Single">Single</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Do you have a credit card?</label>
                    <select name="has_credit_card"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Do you have a checking account?</label>
                    <select name="has_checking_account"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                </div>
            </div>
        </div>

        <div style="clear: both;"></div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step4')">Next</button>
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step2')" style="margin-right: 10px;">Previous</button>
        </div>
   </div>

    <div class="box box-primary accordian_step" id="step4" style="display: none">
        <div class="box-header with-border">
            <h3 class="box-title">  Applicant Address  </h3>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Street #:</label>
                    <input type="text" class="form-control" name="street_number" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Street Name:</label>
                    <input type="text" class="form-control" name="street_name" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Street Type:</label>
                    <select name="street_type"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Avenue">Avenue</option>
                        <option value="Boulevard">Boulevard</option>
                        <option value="Circle">Circle</option>
                        <option value="Court">Court</option>
                        <option value="Cove">Cove</option>
                        <option value="Crescent">Crescent</option>
                        <option value="Drive">Drive</option>
                        <option value="Freeway">Freeway</option>
                        <option value="Highway">Highway</option>
                        <option value="Lane">Lane</option>
                        <option value="Park">Park</option>
                        <option value="Parkway">Parkway</option>
                        <option value="Pass">Pass</option>
                        <option value="Path">Path</option>
                        <option value="Pike">Pike</option>
                        <option value="Place">Place</option>
                        <option value="Plaza">Plaza</option>
                        <option value="Road">Road</option>
                        <option value="Square">Square</option>
                        <option value="Street">Street</option>
                        <option value="Terrace">Terrace</option>
                        <option value="Trail">Trail</option>
                        <option value="Turnpike">Turnpike</option>
                        <option value="Valley">Valley</option>
                        <option value="Way">Way</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Apt/St #:</label>
                    <input type="text" class="form-control" name="apt_number" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">P.O. Box:</label>
                    <input type="text" class="form-control" name="po_box" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Rural Route:</label>
                    <input type="text" class="form-control" name="rural_route" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">City:</label>
                    <input type="text" class="form-control" name="city" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">State:</label>
                    <select name="state"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District of Col</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                        <option value="AS">American Samoa</option>
                        <option value="FM">Federated State</option>
                        <option value="GU">Guam</option>
                        <option value="MH">Marshall Island</option>
                        <option value="MP">Northern Marian</option>
                        <option value="PW">Palau</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="UM">U.S. Minor Outl</option>
                        <option value="VI">Virgin Islands</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Country Code:</label>
                    <select name="country_code"  class="form-control select2" style="width: 100%;">

                        <option value="USA">USA</option>
                        <option value="CA">CA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Zip Code:</label>
                    <input type="text" class="form-control" name="zipcode" placeholder="">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Years at Current Address:</label>
                    <input type="text" class="form-control" name="years_at_address" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Months at Current Address:</label>
                    <input type="text" class="form-control" name="months_at_address" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Home Phone:</label>
                    <input type="text" class="form-control" name="homephone" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Cell Phone:</label>
                    <input type="text" class="form-control" name="varphone" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Housing Type:</label>
                    <select name="housing_type"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Family">Family</option>
                        <option value="Other">Other</option>
                        <option value="Own">Own</option>
                        <option value="Rent">Rent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Rent/Mortgage Payment:</label>
                    <input type="text" class="form-control" name="rent_mortgage_pmt" placeholder="">
                </div>
            </div>
        </div>

        <div style="clear: both;"></div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step5')">Next</button>
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step3')" style="margin-right: 10px;">Previous</button>
        </div>
    </div>

    <div class="box box-primary accordian_step" id="step5" style="display: none">
        <div class="box-header with-border">
            <h3 class="box-title">   Applicant Employment </h3>
        </div>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Employment:</label>
                    <select name="employment"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Disability">Disability</option>
                        <option value="Employed - Full Time">Employed - Full Time</option>
                        <option value="Employed - Part Time">Employed - Part Time</option>
                        <option value="Full Time Student">Full Time Student</option>
                        <option value="Homemaker">Homemaker</option>
                        <option value="Other">Other</option>
                        <option value="Retired">Retired</option>
                        <option value="Self-Employed">Self-Employed</option>
                        <option value="Social Assistance">Social Assistance</option>
                        <option value="Unemployed">Unemployed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Employed By:</label>
                    <input type="text" class="form-control" name="employed_by" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Business Phone:</label>
                    <input type="text" class="form-control" name="business_phone" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Years at Current:</label>
                    <input type="text" class="form-control" name="years_at_current_emp" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Months at Current:</label>
                    <input type="text" class="form-control" name="months_at_current_emp" placeholder="">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Occupation:</label>
                    <input type="text" class="form-control" name="occupation" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Gross Salary:</label>
                    <input type="text" class="form-control" name="gross_salary" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Income Frequency:</label>
                    <select name="income_freq"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Annually">Annually</option>
                        <option value="BiWeekly">BiWeekly</option>
                        <option value="Daily">Daily</option>
                        <option value="Hourly">Hourly</option>
                        <option value="Monthly">Monthly</option>
                        <option value="SemiMonthly">SemiMonthly</option>
                        <option value="Weekly">Weekly</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Other Income(Monthly):</label>
                    <input type="text" class="form-control" name="other_income" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Source of Other Income:</label>
                    <input type="text" class="form-control" name="source_of_other_income" placeholder="">
                </div>
            </div>
        </div>

        <div style="clear: both;"></div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step6')">Next</button>
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step4')" style="margin-right: 10px;">Previous</button>
        </div>

    </div>


    <div class="box box-primary accordian_step" id="step6" style="display: none">
        <div class="box-header with-border">
            <h3 class="box-title"> Personal References </h3>
        </div>
        <div class="col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title"> References 1</h3>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" name="reference_name_1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Relationship:</label>
                    <select name="reference_relationship_1"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Child">Child</option>
                        <option value="Friend">Friend</option>
                        <option value="Other Relative">Other Relative</option>
                        <option value="Parent">Parent</option>
                        <option value="Sibling">Sibling</option>
                        <option value="Spouse">Spouse</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number:</label>
                    <input type="text" class="form-control" name="reference_phone_1" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email Address:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="form-control" name="reference_email_1" placeholder="">
                    </div>

                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Physical Address:</label>
                    <input type="text" class="form-control" name="reference_address_1" placeholder="">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box-header with-border">
                <h3 class="box-title"> References 2</h3>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">Name:</label>
                    <input type="text" class="form-control" name="reference_name_2" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Relationship:</label>
                    <select name="reference_relationship_2"  class="form-control select2" style="width: 100%;">

                        <option value="">Select</option>
                        <option value="Child">Child</option>
                        <option value="Friend">Friend</option>
                        <option value="Other Relative">Other Relative</option>
                        <option value="Parent">Parent</option>
                        <option value="Sibling">Sibling</option>
                        <option value="Spouse">Spouse</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone Number:</label>
                    <input type="text" class="form-control" name="reference_phone_2" placeholder="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email Address:</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="form-control" name="reference_email_2" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Physical Address:</label>
                    <input type="text" class="form-control" name="reference_address_2" placeholder="">
                </div>
            </div>
        </div>

        <div style="clear: both;"></div>
        <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right" onclick="return submitApplication()">Submit</button>
            <button type="submit" class="btn btn-info pull-right" onclick="return showNextDepartment('step5')" style="margin-right: 10px;">Previous</button>
        </div>

    </div>

</form>

<div style="clear: both;"></div>

<script type="text/javascript">
    function showNextDepartment(step) {
        $(".accordian_step").hide();
        $("#"+step).show();
        return false;
    }
    function submitApplication() {
        alert('Submitting the application which will just saves the information')
    }
</script>
