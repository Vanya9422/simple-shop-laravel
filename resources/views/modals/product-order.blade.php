<div class="modal fade order-modal"  tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="order-form" name="orderForm">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group ">
                                <label for="name" class="col-form-label text-md-right">{{ __('Name') }}*</label>
                                <div>
                                    <input id="name" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                                    <span class="invalid-feedback" id="invalid-name" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-form-label text-md-right">{{ __('Last Name') }}*</label>
                                <div>
                                    <input id="last_name" type="text" class="form-control" name="last_name" required>
                                    <span class="invalid-feedback" id="invalid-password" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address*') }}</label>
                                <div>
                                    <input id="email" type="text" class="form-control" name="email" required autocomplete="email">
                                    <span class="invalid-feedback" id="invalid-email" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-form-label text-md-right">{{ __('Phone Number*') }}</label>
                                <div>
                                    <input id="phone" type="number" class="form-control" name="phone" required  autofocus/>
                                    <span class="invalid-feedback" id="invalid-phone" role="alert"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="region" class="col-form-label text-md-right">{{ __('Region*') }}</label>
                                <div>
                                    <input id="region" type="text" class="form-control" name="region" required>
                                    <span class="invalid-feedback" id="invalid-region" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-form-label text-md-right">{{ __('City*') }}</label>
                                <div>
                                    <input id="city" type="text" class="form-control" name="city" required>
                                    <span class="invalid-feedback" id="invalid-city" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-form-label text-md-right">{{ __('Address*') }}</label>
                                <div>
                                    <input id="address" type="text" class="form-control" name="address" required>
                                    <span class="invalid-feedback" id="invalid-address" role="alert"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="zip" class="col-form-label text-md-right">{{ __('Zip Code*') }}</label>
                                <div>
                                    <input id="zip" type="number" class="form-control" name="zip" minlength="2" required>
                                    <span class="invalid-feedback" id="invalid-zip" role="alert"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="col-form-label text-md-right">{{ __('Quantity*') }}</label>
                        <div>
                            <input id="quantity" type="number" class="form-control" name="quantity" required>
                            <span class="invalid-feedback" id="invalid-quantity" role="alert"></span>
                        </div>
                    </div>
                    <div class="form-group" id="before-register">
                        <label for="order-message" class="col-form-label text-md-right">{{ __('Message:') }}</label>
                        <div>
                            <textarea class="form-control" id="order-message" name="message"></textarea>
                            <span class="invalid-feedback" id="invalid-message" role="alert"></span>
                        </div>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="with_registration" value="0"  name="with_registration">
                        <label class="form-check-label" for="with_registration">Create a profile with completed data</label>
                    </div>
                    <input type="hidden" class="form-control" id="product" name="product">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-order-form">Add Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="optional-block">
    <div class="form-group">
        <label for="username" class="col-form-label text-md-right">{{ __('Username:*') }}</label>
        <div>
            <input id="username" type="text" class="form-control" name="username" required maxlength="250" minlength="2">
            <span class="invalid-feedback invalid-username" role="alert"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-form-label text-md-right">{{ __('Password:*') }}</label>
        <div>
            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" minlength="8">
            <span class="invalid-feedback invalid-password" role="alert"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password:*') }}</label>
        <div>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" minlength="8">
        </div>
    </div>
</div>
