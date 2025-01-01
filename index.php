@extends('layouts.app')



@section('content')

<div class="page-wrapper">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.restaurant_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item">{{trans('lang.restaurant_plural')}}</li>
                <li class="breadcrumb-item active">{{trans('lang.restaurant_table')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>

    <div class="container-fluid">
        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">
            {{trans('lang.processing')}}</div>

        <div class="admin-top-section">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex top-title-section pb-4 justify-content-between">
                        <div class="d-flex top-title-left align-self-center">
                            <span class="icon mr-3"><img src="{{ asset('images/hotel.png') }}"></span>
                            <h3 class="mb-0">Restaurants</h3>
                            <span class="counter ml-3 rest_count"></span>
                        </div>
                        <div class="d-flex top-title-right align-self-center">
                            <div class="select-box pl-3">
                                <select class="form-control restaurant_type_selector">
                                    <option value="" disabled selected>Restaurant Type</option>
                                </select>
                            </div>
                            <div class="select-box pl-3">
                                <select class="form-control business_model_selector">
                                    <option value="" disabled selected>Business Model</option>
                                </select>
                            </div>
                            <div class="select-box pl-3">
                                <select class="form-control cuisine_selector">
                                    <option value="" disabled selected>Select Cuisine</option>
                                </select>
                            </div>
                            <div class="select-box pl-3">
                                <select class="form-control zone_selector">
                                    <option value="" disabled selected>Select Zone</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card card-box-with-icon">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="card-box-with-content">
                                                <h4 class="text-dark-2 mb-1 h4 rest_count">00</h4>
                                                <p class="mb-0 small text-dark-2">Total restaurants</p>
                                            </div>
                                            <span class="box-icon ab"><img
                                                    src="{{ asset('images/restaurant_icon.png') }}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-box-with-icon">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="card-box-with-content">
                                                <h4 class="text-dark-2 mb-1 h4 rest_active_count">00</h4>
                                                <p class="mb-0 small text-dark-2">Active restaurants</p>
                                            </div>
                                            <span class="box-icon ab"><img
                                                    src="{{ asset('images/active_restaurant.png') }}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-box-with-icon">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="card-box-with-content">
                                                <h4 class="text-dark-2 mb-1 h4 total_transaction">$00</h4>
                                                <p class="mb-0 small text-dark-2">Total transactions</p>
                                            </div>
                                            <span class="box-icon ab"><img
                                                    src="{{ asset('images/transaction_icon.png') }}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-box-with-icon">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="card-box-with-content">
                                                <h4 class="text-dark-2 mb-1 h4 commission_earned">$00</h4>
                                                <p class="mb-0 small text-dark-2">Commission earned</p>
                                            </div>
                                            <span class="box-icon ab"><img
                                                    src="{{ asset('images/commision_icon.png') }}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-box-with-icon">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="card-box-with-content">
                                                <h4 class="text-dark-2 mb-1 h4 rest_inactive_count">00</h4>
                                                <p class="mb-0 small text-dark-2">Inactive restaurants</p>
                                            </div>
                                            <span class="box-icon ab"><img
                                                    src="{{ asset('images/inactive_restaurant.png') }}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-box-with-icon">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="card-box-with-content">
                                                <h4 class="text-dark-2 mb-1 h4 new_joined_rest">00</h4>
                                                <p class="mb-0 small text-dark-2">Newly joined restaurants</p>
                                            </div>
                                            <span class="box-icon ab"><img
                                                    src="{{ asset('images/new_restaurant.png') }}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card card-box-with-icon">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="card-box-with-content">
                                                <h4 class="text-dark-2 mb-1 h4 rest_withdraws">$00</h4>
                                                <p class="mb-0 small text-dark-2">Total restaurant withdraws</p>
                                            </div>
                                            <span class="box-icon ab"><img
                                                    src="{{ asset('images/withdrawal_icon.png') }}"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="table-list">
            <div class="row">
                <div class="col-12">
                    <div class="card border">
                        <div class="card-header d-flex justify-content-between align-items-center border-0">
                            <div class="card-header-title">
                                <h3 class="text-dark-2 mb-2 h4">Restaurants list</h3>
                                <p class="mb-0 text-dark-2">View and manage all the restaurants</p>
                            </div>
                            <div class="card-header-right d-flex align-items-center">
                                <div class="card-header-btn mr-3">
                                    <a href="{!! route('restaurants.create') !!}"
                                        class="btn-primary btn rounded-full"><i
                                            class="mdi mdi-plus mr-2"></i>{{trans('lang.create_restaurant')}}</a>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive m-t-10">
                                <table id="storeTable"
                                    class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <?php if (in_array('restaurant.delete', json_decode(@session('user_permissions'), true))) { ?>
                                            <th class="delete-all"><input type="checkbox" id="is_active"><label
                                                    class="col-3 control-label" for="is_active"><a id="deleteAll"
                                                        class="do_not_delete" href="javascript:void(0)"><i
                                                            class="fa fa-trash"></i> {{trans('lang.all')}}</a></label>
                                            </th>
                                            <?php } ?>
                                            <th>Restaurant Info</th>
                                            <!-- <th>{{trans('lang.restaurant_image')}}</th>
                                        <th>{{trans('lang.restaurant_name')}}</th> -->
                                            <th>Owner Info</th>
                                            <!-- <th>{{trans('lang.restaurant_phone')}}</th> -->
                                            <th>{{trans('lang.date')}}</th>
                                            <!-- <th>{{trans('lang.order_transactions')}}</th> -->
                                            <th>{{trans('lang.wallet_history')}}</th>
                                            <th>{{trans('lang.food_plural')}}</th>
                                            <th>{{trans('lang.order_plural')}}</th>
                                            <th>{{trans('lang.actions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="append_restaurants"></tbody>
                                </table>
                            </div>
                            <!-- Popup -->




                            <div class="modal fade" id="create_vendor" tabindex="-1" role="dialog" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered notification-main" role="document">

                                    <div class="modal-content">

                                        <div class="modal-header">

                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                {{trans('lang.copy_vendor')}}

                                                <span id="vendor_title_lable"></span>

                                            </h5>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                <span aria-hidden="true">&times;</span>

                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <div id="data-table_processing"
                                                class="dataTables_processing panel panel-default"
                                                style="display: none;">

                                                {{trans('lang.processing')}}

                                            </div>

                                            <div class="error_top"></div>

                                            <!-- Form -->

                                            <div class="form-row">

                                                <div class="col-md-12 form-group">

                                                    <label class="form-label">{{trans('lang.first_name')}}</label>

                                                    <div class="input-group">

                                                        <input placeholder="Name" type="text" id="user_name"
                                                            class="form-control">

                                                    </div>

                                                </div>

                                                <div class="col-md-12 form-group">

                                                    <label class="form-label">{{trans('lang.last_name')}}</label>

                                                    <div class="input-group">

                                                        <input placeholder="Name" type="text" id="user_last_name"
                                                            class="form-control">

                                                    </div>

                                                </div>

                                                <div class="col-md-12 form-group">

                                                    <label class="form-label">{{trans('lang.vendor_title')}}</label>

                                                    <div class="input-group">

                                                        <input placeholder="Vendor Title" type="text" id="vendor_title"
                                                            class="form-control">

                                                    </div>

                                                </div>

                                                <div class="col-md-12 form-group"><label
                                                        class="form-label">{{trans('lang.email')}}</label><input
                                                        placeholder="Email" value="" id="user_email" type="text"
                                                        class="form-control"></div>

                                                <div class="col-md-12 form-group"><label
                                                        class="form-label">{{trans('lang.password')}}</label><input
                                                        placeholder="Password" id="user_password" type="password"
                                                        class="form-control">

                                                </div>



                                            </div>

                                            <!-- Form -->

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button"
                                                class="btn btn-primary save-form-btn">{{trans('lang.create')}}

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- Popup -->
                        </div>

                    </div>
                </div>
            </div>
        </div>



    </div>



</div>


@endsection



@section('scripts')



<script type="text/javascript">
var database = firebase.firestore();

var refData = database.collection('vendors');
$('select').change(async function() {
    var zoneValue = $('.zone_selector').val();
    var restaurantTypeValue = $('.restaurant_type_selector').val();
    var businessModelValue = $('.business_model_selector').val();
    var cuisineValue = $('.cuisine_selector').val();

    refData = database.collection('vendors');

    if (zoneValue) {
        refData = refData.where('zoneId', '==', zoneValue);
    }
    if (restaurantTypeValue) {
        // refData = refData.where('restaurantType', '==', restaurantTypeValue);
    }
    if (businessModelValue) {
        var vendorSelectedIds = await subscriptionPlanVendorIds(businessModelValue);
        if (vendorSelectedIds.length > 0) {
            refData = refData.where('id', 'in', vendorSelectedIds);
        } else {
            refData = refData.where('id', '==', null);
        }
    }
    if (cuisineValue) {
        refData = refData.where('categoryID', '==', cuisineValue);
    }
    $('#storeTable').DataTable().ajax.reload();
});
async function subscriptionPlanVendorIds(businessModelValue) {
    var vendorIds = []
    try {
        const querySnapshot = await database.collection('users').where('subscriptionPlanId', '==',
            businessModelValue).get();
        vendorIds = querySnapshot.docs.map(doc => doc.data().vendorID).filter(vendorID => vendorID !== undefined &&
            vendorID !== null && vendorID !== '');
    } catch (error) {
        console.error("Error fetching users:", error);
    }
    return vendorIds;
}

var append_list = '';



var placeholderImage = '';



var user_permissions = '<?php echo @session("user_permissions") ?>';

user_permissions = Object.values(JSON.parse(user_permissions));

var checkDeletePermission = false;

if ($.inArray('restaurant.delete', user_permissions) >= 0) {

    checkDeletePermission = true;

}



var userData = [];

var vendorData = [];

var vendorProducts = [];


database.collection('zone').where('publish', '==', true).orderBy('name', 'asc').get().then(async function(snapshots) {
    snapshots.docs.forEach((listval) => {
        var data = listval.data();
        $('.zone_selector').append($("<option></option>")
            .attr("value", data.id)
            .text(data.name));
    })
});
database.collection('vendor_categories').where('publish', '==', true).get().then(async function(snapshots) {
    snapshots.docs.forEach((listval) => {
        var data = listval.data();
        $('.cuisine_selector').append($("<option></option>")
            .attr("value", data.id)
            .text(data.title));
    })
});
database.collection('subscription_plans').where('isEnable', '==', true).orderBy('name', 'asc').get().then(snapshots => {
    snapshots.docs.forEach(doc => {
        const {
            expiryDay,
            createdAt,
            id,
            name,
            type
        } = doc.data();
        if (expiryDay && createdAt) {
            const expiryDate = new Date(createdAt.toDate());
            expiryDate.setDate(expiryDate.getDate() + parseInt(expiryDay, 10));
            if (type !== "free" && expiryDate > new Date()) {
                $('.business_model_selector').append($("<option>").attr("value", id).text(name));
            } else {
                $('.business_model_selector').append($("<option>").attr("value", id).text(name));
            }
        }
    });
});
// database.collection('restaurant_type_selector').where('publish', '==', true).orderBy('name','asc').get().then(async function (snapshots) {
//     snapshots.docs.forEach((listval) => {
//         var data = listval.data();
//         $('.cuisine_selector').append($("<option></option>")
//             .attr("value", data.id)
//             .text(data.name));
//     })
// });
$('.zone_selector').select2({
    placeholder: "Select Zone",
    minimumResultsForSearch: Infinity,
    allowClear: true
});
$('.restaurant_type_selector').select2({
    placeholder: "Restaurant Type",
    minimumResultsForSearch: Infinity,
    allowClear: true
});
$('.business_model_selector').select2({
    placeholder: "Business Model",
    minimumResultsForSearch: Infinity,
    allowClear: true
});
$('.cuisine_selector').select2({
    placeholder: "Select Cuisine",
    minimumResultsForSearch: Infinity,
    allowClear: true
});

var placeholder = database.collection('settings').doc('placeHolderImage');



placeholder.get().then(async function(snapshotsimage) {

    var placeholderImageData = snapshotsimage.data();

    placeholderImage = placeholderImageData.image;

})

$(document).ready(function() {



    jQuery("#data-table_processing").show();

    const table = $('#storeTable').DataTable({
        pageLength: 10,
        processing: false,
        serverSide: true,
        responsive: true,
        ajax: async function(data, callback, settings) {
            const start = data.start;
            const length = data.length;
            const searchValue = data.search.value.toLowerCase();
            const orderColumnIndex = data.order[0].column;
            const orderDirection = data.order[0].dir;
            const orderableColumns = (checkDeletePermission) ? ['', 'title', 'phone', 'createdAt',
                '', 'foods', 'orders', ''
            ] : ['title', 'phone', 'createdAt', '', 'foods', 'orders', ''];
            const orderByField = orderableColumns[orderColumnIndex];
            if (searchValue.length >= 3 || searchValue.length === 0) {
                $('#data-table_processing').show();
            }
            await refData.orderBy('createdAt', 'desc').get().then(async function(querySnapshot) {
                if (querySnapshot.empty) {
                    console.error("No data found in Firestore.");
                    $('#data-table_processing').hide();
                    callback({
                        draw: data.draw,
                        recordsTotal: 0,
                        recordsFiltered: 0,
                        filteredData: [],
                        data: []
                    });
                    return;
                }
                let records = [];
                let filteredRecords = [];
                await Promise.all(querySnapshot.docs.map(async (doc) => {
                    let childData = doc.data();
                    childData.phone = (childData.phonenumber != '' &&
                            childData.phonenumber != null && childData
                            .phonenumber.slice(0, 1) == '+') ? childData
                        .phonenumber.slice(1) : childData.phonenumber;
                    childData.id = doc.id;
                    if (childData.id) {
                        childData.orders = await getTotalOrders(
                            childData.id);
                        childData.foods = await getTotalProduct(
                            childData.id);
                    } else {
                        childData.orders = 0;
                        childData.foods = 0;
                    }
                    if (searchValue) {
                        var date = '';
                        var time = '';
                        if (childData.hasOwnProperty("createdAt")) {
                            try {
                                date = childData.createdAt.toDate()
                                    .toDateString();
                                time = childData.createdAt.toDate()
                                    .toLocaleTimeString('en-US');
                            } catch (err) {}
                        }
                        var createdAt = date + ' ' + time;
                        if (
                            (childData.title && childData.title
                                .toLowerCase().toString().includes(
                                    searchValue)) ||
                            (createdAt && createdAt.toString()
                                .toLowerCase().indexOf(searchValue) > -1
                            ) ||
                            (childData.email && childData.email
                                .toLowerCase().toString().includes(
                                    searchValue)) ||
                            (childData.phoneNumber && childData
                                .phoneNumber.toString().includes(
                                    searchValue))
                        ) {
                            filteredRecords.push(childData);
                        }
                    } else {
                        filteredRecords.push(childData);
                    }
                }));
                filteredRecords.sort((a, b) => {
                    let aValue = a[orderByField] ? a[orderByField].toString()
                        .toLowerCase() : '';
                    let bValue = b[orderByField] ? b[orderByField].toString()
                        .toLowerCase() : '';
                    if (orderByField === 'createdAt') {
                        try {
                            aValue = a[orderByField] ? new Date(a[orderByField]
                                .toDate()).getTime() : 0;
                            bValue = b[orderByField] ? new Date(b[orderByField]
                                .toDate()).getTime() : 0;
                        } catch (err) {}
                    }
                    if (orderByField === 'foods') {
                        aValue = a[orderByField] ? parseInt(a[orderByField]) :
                            0;
                        bValue = b[orderByField] ? parseInt(b[orderByField]) :
                            0;
                    }
                    if (orderByField === 'orders') {
                        aValue = a[orderByField] ? parseInt(a[orderByField]) :
                            0;
                        bValue = b[orderByField] ? parseInt(b[orderByField]) :
                            0;
                    }
                    if (orderDirection === 'asc') {
                        return (aValue > bValue) ? 1 : -1;
                    } else {
                        return (aValue < bValue) ? 1 : -1;
                    }
                });
                const totalRecords = filteredRecords.length;

                let active_rest = 0;
                let inactive_rest = 0;
                let new_joined_rest = 0;
                let total_transaction = "$00";
                let commission_earned = 00;
                let rest_withdraws = "$00";
                const today = new Date().setHours(0, 0, 0, 0);

                await Promise.all(filteredRecords.map(async (childData) => {
                    var isActive = false;
                    if (childData.author) {
                        const user_id = childData.author;
                        isActive = await vendorStatus(user_id);
                    }
                    // total_transaction = total_transaction + vendorTransaction(user_id);
                    if (isActive) {
                        active_rest += 1;
                    } else {
                        inactive_rest += 1;
                    }
                    if (childData.createdAt && new Date(childData
                            .createdAt.seconds * 1000).setHours(0, 0, 0,
                            0) === today) {
                        new_joined_rest += 1;
                    }
                }));

                $('.rest_count').text(totalRecords);
                $('.rest_active_count').text(active_rest);
                $('.rest_inactive_count').text(inactive_rest);
                $('.total_transaction').text(total_transaction);
                $('.commission_earned').text(commission_earned);
                $('.new_joined_rest').text(new_joined_rest);
                $('.rest_withdraws').text(rest_withdraws);

                const paginatedRecords = filteredRecords.slice(start, start + length);
                await Promise.all(paginatedRecords.map(async (childData) => {
                    var getData = await buildHTML(childData);
                    records.push(getData);
                }));
                $('#data-table_processing').hide();
                callback({
                    draw: data.draw,
                    recordsTotal: totalRecords,
                    recordsFiltered: totalRecords,
                    filteredData: filteredRecords,
                    data: records
                });
            }).catch(function(error) {
                console.error("Error fetching data from Firestore:", error);
                $('#data-table_processing').hide();
                callback({
                    draw: data.draw,
                    recordsTotal: 0,
                    recordsFiltered: 0,
                    filteredData: [],
                    data: []
                });
            });
        },
        order: (checkDeletePermission) ? [
            [4, 'desc']
        ] : [
            [3, 'desc']
        ],
        columnDefs: [{
                targets: (checkDeletePermission) ? 4 : 3,
                type: 'date',
                render: function(data) {
                    return data;
                }
            },
            {
                orderable: false,
                targets: (checkDeletePermission) ? [0, 4, 7] : [3, 6]
            },
        ],
        "language": {
            "zeroRecords": "{{trans('lang.no_record_found')}}",
            "emptyTable": "{{trans('lang.no_record_found')}}",
            "processing": ""
        },
        dom: 'lfrtipB',
        buttons: [{
            extend: 'collection',
            text: '<i class="mdi mdi-cloud-download"></i> Export as',
            className: 'btn btn-info',
            buttons: [{
                    extend: 'csvHtml5',
                    text: 'Export CSV',
                    title: 'Store Data',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        }
                    },
                    action: function(e, dt, button, config) {
                        exportData(dt, 'csv');
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Export Excel',
                    title: 'Store Data',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        }
                    },
                    action: function(e, dt, button, config) {
                        exportData(dt, 'excel');
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'Export PDF',
                    title: 'Store Data',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        }
                    },
                    action: function(e, dt, button, config) {
                        exportData(dt, 'pdf');
                    }
                }
            ]
        }],
        initComplete: function() {
            $(".dataTables_filter").append($(".dt-buttons").detach());
            $('#storeTable_filter input').attr('placeholder', 'Search here...').val('');
            $('#storeTable_filter label').contents().filter(function() {
                return this.nodeType === 3;
            }).remove();
        }
    });

    function exportData(dt, format) {
        const filteredRecords = dt.ajax.json().filteredData;
        const columns = ['ID', 'Photo', 'Store Name', 'Phone Number', 'Total Orders', 'Created At', 'Location'];

        const tableData = filteredRecords.map(record => [
            record.id || '',
            record.photo || '',
            record.title || '',
            record.phonenumber || '',
            record.orders || 0,
            record.createdAt ? new Date(record.createdAt.seconds * 1000).toLocaleString() : '',
            record.location || '',
        ]);

        const data = [columns, ...tableData];

        if (format === 'csv') {
            const csv = data.map(row => row.map(cell => {
                if (typeof cell === 'string' && (cell.includes(',') || cell.includes('\n') || cell
                        .includes('"'))) {
                    return `"${cell.replace(/"/g, '""')}"`;
                }
                return cell;
            }).join(',')).join('\n');

            const blob = new Blob([csv], {
                type: 'text/csv;charset=utf-8;'
            });
            saveAs(blob, 'Store_Data.csv');
        } else if (format === 'excel') {
            const ws = XLSX.utils.aoa_to_sheet(data, {
                cellDates: true
            });
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, 'Store Data');
            XLSX.writeFile(wb, 'Store_Data.xlsx');
        } else if (format === 'pdf') {
            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF();

            doc.setFontSize(16);
            doc.text('Store Data', 14, 16);

            doc.autoTable({
                head: [data[0]],
                body: data.slice(1),
                startY: 30,
                theme: 'striped',
                columnStyles: {
                    0: {
                        cellWidth: 20
                    },
                    1: {
                        cellWidth: 30
                    },
                    2: {
                        cellWidth: 40
                    },
                    3: {
                        cellWidth: 30
                    },
                    4: {
                        cellWidth: 30
                    },
                    5: {
                        cellWidth: 50
                    },
                    6: {
                        cellWidth: 50
                    },
                },
                margin: {
                    top: 30,
                    bottom: 30
                },
                styles: {
                    cellPadding: 4,
                    fontSize: 10,
                },
                didDrawPage: function(data) {
                    doc.setFontSize(10);
                    doc.text('Store Data Export', data.settings.margin.left, 10);
                }
            });
            doc.save('Store_Data.pdf');
        } else {
            console.error('Unsupported format');
        }
    }


    function debounce(func, wait) {

        let timeout;

        const context = this;

        return function(...args) {

            clearTimeout(timeout);

            timeout = setTimeout(() => func.apply(context, args), wait);

        };

    }

    $('#search-input').on('input', debounce(function() {

        const searchValue = $(this).val();
        alert(searchValue);
        if (searchValue.length >= 3) {

            $('#data-table_processing').show();

            table.search(searchValue).draw();

        } else if (searchValue.length === 0) {

            $('#data-table_processing').show();

            table.search('').draw();

        }

    }, 300));
});







async function buildHTML(val) {



    var html = [];

    var id = val.id;
    var vendorUserId = val.author;

    var route1 = '{{route("restaurants.edit",":id")}}';
    route1 = route1.replace(':id', id);

    var route_view = '{{route("restaurants.view",":id")}}';
    route_view = route_view.replace(':id', id);
    if (checkDeletePermission) {
        html.push('<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' +
            id + '" author="' + val.author + '"><label class="col-3 control-label"\n' +
            'for="is_open_' + id + '" ></label></td>');
    }

    // if (val.photo != '' && val.photo != null) {
    //     html.push('<img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" alt="" width="100%" style="width:70px;height:70px;" src="' + val.photo + '" alt="image">');

    // } else {

    //     html.push('<img alt="" width="100%" style="width:70px;height:70px;" src="' + placeholderImage + '" alt="image">');
    // }

    // if(val.title != null && val.title != ""){
    //     html.push('<a href="' + route_view + '">' + val.title + '</a>');
    // }
    // else
    // {
    //     html.push('');
    // }
    var restaurantInfo = '';
    if (val.photo != '' && val.photo != null) {
        restaurantInfo += '<img onerror="this.onerror=null;this.src=\'' + placeholderImage +
            '\'" alt="" width="100%" style="width:70px;height:70px;" src="' + val.photo + '" alt="image">';
    } else {
        restaurantInfo += '<img alt="" width="100%" style="width:70px;height:70px;" src="' + placeholderImage +
            '" alt="image">';
    }
    if (val.title != " " && val.title != "null" && val.title != null && val.title != "") {
        restaurantInfo += '<a href="' + route_view + '">' + val.title + '</a>';
    } else {
        restaurantInfo += 'UNKNOWN';
    }
    html.push(restaurantInfo);

    var ownerInfo = '';
    if (val.authorName) {
        ownerInfo += '<a href="' + route_view + '">' + val.title + '</a>'
    }
    if (val.hasOwnProperty('phonenumber') && val.phonenumber != null && val.phonenumber != "") {
        html.push(shortEditNumber(val.phonenumber));
    } else {
        html.push('');
    }

    var date = '';
    var time = '';
    if (val.hasOwnProperty("createdAt")) {
        try {
            date = val.createdAt.toDate().toDateString();
            time = val.createdAt.toDate().toLocaleTimeString('en-US');
        } catch (err) {

        }
        html.push('<span class="dt-time">' + date + ' ' + time + '</span>');
    } else {
        html.push('');
    }

    var payoutRequests = '{{route("users.walletstransaction",":id")}}';
    payoutRequests = payoutRequests.replace(':id', val.author);

    html.push('<a href="' + payoutRequests + '">{{trans("lang.wallet_history")}}</a>');

    var active = val.isActive;
    var vendorId = val.id;
    var url = '{{route("restaurants.foods",":id")}}';
    url = url.replace(":id", vendorId);
    html.push('<a href = "' + url + '">' + val.foods + '</a>');

    var url2 = '{{route("restaurants.orders",":id")}}';
    url2 = url2.replace(":id", vendorId);
    html.push('<a href="' + url2 + '">' + val.orders + '</a>');
    var actionHtml = '';
    actionHtml += '<span class="action-btn"><a href="javascript:void(0)" vendor_id="' + val.id + '" author="' + val
        .author + '" name="vendor-clone"><i class="mdi mdi-content-copy"></i></a><a href="' + route_view +
        '"><i class="mdi mdi-eye"></i></a><a href="' + route1 + '"><i class="mdi mdi-lead-pencil"></i></a>';
    if (checkDeletePermission) {
        actionHtml += '<a id="' + val.id + '" author="' + val.author +
            '" name="vendor-delete" class="delete-btn" href="javascript:void(0)"><i class="mdi mdi-delete"></i></a></span>';
    }
    html.push(actionHtml);
    return html;


}

async function vendorStatus(id) {
    let status = true;
    await database.collection('users').doc(id).get().then((snapshots) => {
        let data = snapshots.data();
        if (data) {
            status = data.active;
        }
    });
    return status;
}

async function getTotalProduct(id) {

    var Product_total = 0;



    await database.collection('vendor_products').where('vendorID', '==', id).get().then(async function(
        productSnapshots) {

        Product_total = productSnapshots.docs.length;



    });



    return Product_total;

}



async function getTotalOrders(id) {

    var order_total = 0;



    await database.collection('restaurant_orders').where('vendorID', '==', id).get().then(async function(
        productSnapshots) {

        order_total = productSnapshots.docs.length;



    });



    return order_total;

}



$("#is_active").click(function() {

    $("#storeTable .is_open").prop('checked', $(this).prop('checked'));



});



$("#deleteAll").click(function() {

    if ($('#storeTable .is_open:checked').length) {

        if (confirm("{{trans('lang.selected_delete_alert')}}")) {

            jQuery("#data-table_processing").show();

            $('#storeTable .is_open:checked').each(function() {

                    var dataId = $(this).attr('dataId');

                    var author = $(this).attr('author');



                    database.collection('users').doc(author).update({
                        'vendorID': ""
                    }).then(function(result) {
                        deleteDocumentWithImage('vendors', dataId, "photo", ['restaurantMenuPhotos',
                                'photos'
                            ])
                            .then(() => {
                                return deleteStoreData(dataId);
                            })
                            .then(() => {
                                window.location.reload();
                            })
                            .catch((error) => {
                                console.error('Error deleting document or store data:', error);
                            });
                    });





                }

            );



        }

    } else {

        alert("{{trans('lang.select_delete_alert')}}");

    }

});





$(document.body).on('click', '.redirecttopage', function() {

    var url = $(this).attr('data-url');

    window.location.href = url;

});



$(document).on("click", "a[name='vendor-delete']", function(e) {

    var id = this.id;

    jQuery("#data-table_processing").show();

    var author = $(this).attr('author');

    if (confirm("{{trans('lang.selected_delete_alert')}}")) {

        deleteDocumentWithImage('vendors', id, "photo", ['restaurantMenuPhotos', 'photos'])
            .then(() => {
                return deleteStoreData(id);
            })
            .then(() => {
                window.location.reload();
            })
            .catch((error) => {
                console.error('Error deleting document with image or store data:', error);
            });


    }

});

async function deleteStoreData(storeId) {

    await database.collection('users').where('vendorID', '==', storeId).get().then(async function(userssanpshots) {



        if (userssanpshots.docs.length > 0) {

            var item_data = userssanpshots.docs[0].data();

            await database.collection('wallet').where('user_id', '==', item_data.id).get().then(
                async function(snapshotsItem) {

                    if (snapshotsItem.docs.length > 0) {

                        snapshotsItem.docs.forEach((temData) => {

                            var item_data = temData.data();

                            database.collection('wallet').doc(item_data.id).delete()
                                .then(function() {});

                        });

                    }

                });

            database.collection('settings').doc("Version").get().then(function(snapshot) {
                var settingData = snapshot.data();
                if (settingData && settingData.storeUrl) {
                    var siteurl = settingData.storeUrl + "/api/delete-user";
                    var dataObject = {
                        "uuid": item_data.id
                    };
                    jQuery.ajax({
                        url: siteurl,
                        method: 'POST',
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify(dataObject),
                        success: function(data) {
                            console.log('Delete user from sql success:', data);
                        },
                        error: function(error) {
                            console.log('Delete user from sql error:', error
                                .responseJSON.message);
                        }
                    });
                }
            });

            var projectId = '<?php echo env('FIREBASE_PROJECT_ID') ?>';

            var dataObject = {
                "data": {
                    "uid": item_data.id
                }
            };



            jQuery.ajax({

                url: 'https://us-central1-' + projectId + '.cloudfunctions.net/deleteUser',

                method: 'POST',

                contentType: "application/json; charset=utf-8",

                data: JSON.stringify(dataObject),

                success: async function(data) {

                    console.log('Delete user success:', data.result);
                    await deleteDocumentWithImage('users', item_data.id,
                        'profilePictureURL');

                },

                error: function(xhr, status, error) {

                    var responseText = JSON.parse(xhr.responseText);

                    console.log('Delete user error:', responseText.error);

                }

            });

        }

    });
    await database.collection('vendor_products').where('vendorID', '==', storeId).get().then(async function(
        snapshots) {
        if (snapshots.docs.length > 0) {
            for (const listval of snapshots.docs) {
                await deleteDocumentWithImage('vendor_products', listval.id, 'photo', 'photos');
            }
        }
    });
    await database.collection('foods_review').where('VendorId', '==', storeId).get().then(async function(
        snapshotsItem) {
        if (snapshotsItem.docs.length > 0) {
            for (const temData of snapshotsItem.docs) {
                await deleteDocumentWithImage('items_review', temData.id, '', 'photos');
            }
        }
    });
    await database.collection('coupons').where('vendorID', '==', storeId).get().then(async function(snapshotsItem) {
        if (snapshotsItem.docs.length > 0) {
            for (const temData of snapshotsItem.docs) {
                await deleteDocumentWithImage('coupons', temData.id, 'image');
            }
        }
    });

    await database.collection('favorite_restaurant').where('restaurant_id', '==', storeId).get().then(
        async function(snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {

                snapshotsItem.docs.forEach((temData) => {

                    var item_data = temData.data();

                    database.collection('favorite_restaurant').doc(item_data.id).delete().then(
                        function() {

                        });

                });

            }

        })

    await database.collection('favorite_item').where('store_id', '==', storeId).get().then(async function(
        snapshotsItem) {

        if (snapshotsItem.docs.length > 0) {

            snapshotsItem.docs.forEach((temData) => {

                var item_data = temData.data();

                database.collection('favorite_item').doc(item_data.id).delete().then(
                    function() {

                    });

            });

        }

    })

    await database.collection('payouts').where('vendorID', '==', storeId).get().then(async function(snapshotsItem) {

        if (snapshotsItem.docs.length > 0) {

            snapshotsItem.docs.forEach((temData) => {

                var item_data = temData.data();

                database.collection('payouts').doc(item_data.id).delete().then(function() {

                });

            });

        }



    });

    await database.collection('booked_table').where('vendorID', '==', storeId).get().then(async function(
        snapshotsItem) {

        if (snapshotsItem.docs.length > 0) {

            snapshotsItem.docs.forEach((temData) => {

                var item_data = temData.data();

                database.collection('booked_table').doc(item_data.id).delete().then(function() {

                });

            });

        }



    });
    await database.collection('story').where('vendorID', '==', storeId).get().then(async function(snapshotsItem) {
        if (snapshotsItem.docs.length > 0) {
            for (const temData of snapshotsItem.docs) {
                await deleteDocumentWithImage('story', temData.id, 'videoThumbnail', 'videoUrl');
            }
        }
    });

}



$(document).on("click", "a[name='vendor-clone']", async function(e) {



    var id = $(this).attr('vendor_id');

    var author = $(this).attr('author');



    await database.collection('users').doc(author).get().then(async function(snapshotsusers) {

        userData = snapshotsusers.data();

    });

    await database.collection('vendors').doc(id).get().then(async function(snapshotsvendors) {

        vendorData = snapshotsvendors.data();

    });

    await database.collection('vendor_products').where('vendorID', '==', id).get().then(async function(
        snapshotsproducts) {

        vendorProducts = [];

        snapshotsproducts.docs.forEach(async (product) => {

            vendorProducts.push(product.data());

        });



    });





    if (userData && vendorData) {

        jQuery("#create_vendor").modal('show');

        jQuery("#vendor_title_lable").text(vendorData.title);

    }

});





$(document).on("click", ".save-form-btn", async function(e) {

    var vendor_id = database.collection("tmp").doc().id;



    if (userData && vendorData) {



        var vendor_title = jQuery("#vendor_title").val();

        var userFirstName = jQuery("#user_name").val();

        var userLastName = jQuery("#user_last_name").val();

        var email = jQuery("#user_email").val();

        var password = jQuery("#user_password").val();



        if (userFirstName == '') {



            $(".error_top").show();

            $(".error_top").html("");

            $(".error_top").append("<p>{{trans('lang.user_name_required')}}</p>");

            window.scrollTo(0, 0);



        } else if (userLastName == '') {



            $(".error_top").show();

            $(".error_top").html("");

            $(".error_top").append("<p>{{trans('lang.user_last_name_required')}}</p>");

            window.scrollTo(0, 0);



        } else if (vendor_title == '') {



            $(".error_top").show();

            $(".error_top").html("");

            $(".error_top").append("<p>{{trans('lang.vendor_title_required')}}</p>");

            window.scrollTo(0, 0);



        } else if (email == '') {



            $(".error_top").show();

            $(".error_top").html("");

            $(".error_top").append("<p>{{trans('lang.user_email_required')}}</p>");

            window.scrollTo(0, 0);

        } else if (password == '') {

            $(".error_top").show();

            $(".error_top").html("");

            $(".error_top").append("<p>{{trans('lang.enter_owners_password_error')}}</p>");

            window.scrollTo(0, 0);

        } else {



            jQuery("#data-table_processing2").show();



            firebase.auth().createUserWithEmailAndPassword(email, password).then(async function(
                firebaseUser) {



                var user_id = firebaseUser.user.uid;



                userData.email = email;

                userData.firstName = userFirstName;

                userData.lastName = userLastName;

                userData.id = user_id;

                userData.vendorID = vendor_id;

                userData.createdAt = createdAt;

                userData.wallet_amount = 0;



                vendorData.author = user_id;

                vendorData.authorName = userFirstName + ' ' + userLastName;

                vendorData.title = vendor_title;

                vendorData.id = vendor_id;

                coordinates = new firebase.firestore.GeoPoint(vendorData.latitude, vendorData
                    .longitude);

                vendorData.coordinates = coordinates;

                vendorData.createdAt = createdAt;



                await database.collection('users').doc(user_id).set(userData).then(
                    async function(result) {



                        await geoFirestore.collection('vendors').doc(vendor_id).set(
                            vendorData).then(async function(result) {

                            var count = 0;

                            await vendorProducts.forEach(async (
                                product) => {

                                var product_id = await database
                                    .collection("tmp").doc().id;

                                product.id = product_id;

                                product.vendorID = vendor_id;

                                await database.collection(
                                        'vendor_products').doc(
                                        product_id).set(product)
                                    .then(function(result) {

                                        count++;

                                        if (count ==
                                            vendorProducts
                                            .length) {

                                            jQuery(
                                                    "#data-table_processing2"
                                                )
                                                .hide();

                                            alert(
                                                'Successfully created.'
                                            );

                                            jQuery(
                                                    "#create_vendor"
                                                )
                                                .modal(
                                                    'hide');

                                            location
                                                .reload();

                                        }

                                    });



                            });





                        });

                    })



            }).catch(function(error) {

                $(".error_top").show();

                jQuery("#data-table_processing2").hide();

                $(".error_top").html("");

                $(".error_top").append("<p>" + error + "</p>");

            });



        }

    }

});
</script>







@endsection