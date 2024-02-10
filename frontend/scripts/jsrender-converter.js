// date formate
$.views.converters("format", date => moment(date).format('MMM D, YYYY'));
// date time from now
$.views.converters("fromNow", date => moment(date).fromNow());
// image name
$.views.converters("imageName", data => Math.floor(Math.random() * 6) + 1);
// status
$.views.converters("statusColor", archive => archive ? 'danger' : 'success');
$.views.converters("status", archive => archive ? 'Deleted' : 'Active');
