What Goes In is a php library to visualize variable usage in a project. In short, it provides a tool to trace the path a variable takes through an application, and identify every usage of it, or of decendants of it (string concatenation, etc). This provides an easy interface to help determine the impact of an insecure variable.

What Goes In depends upon the concept that at some level everything you can do to user-input that might be harmful depends upon calling a function.  This library will be able to accept several types of input, and produce several types of output.  It currently accepts only xdebug trace files created in machine readable mode, and outputs only to an html page with some basic styling.  A large porition of this still requires a heavy user tax.  At this stage, this is unavoidable.  In the future, the library should automate most of these tasks.

NOTE: This library is designed to read into memory multi-megabyte trace files, and parse the whole thing in one go, then display the whole thing to the user.  This is expensive both in terms of memory, cpu-time, and bandwidth.  Future version may allow some form of incremental parsing, but fundamentally, if you're trying to trace a variable through an application, you need to see every function call.

In order to use What Goes In, you'll need the following lines appended to your php.ini.

	zend_extension="/usr/lib/php/extensions/xdebug.so" ; Configurable, location of your xdebug.so
	
	[xdebug]
	xdebug.auto_trace = 1                              ; Required.  If you have xdebug 2.2, you can use xdebug.trace_trigger instead.
	xdebug.trace_format = 1                            ; Required.
	xdebug.trace_options = 0                           ; Required.
	xdebug.trace_output_dir = /output/xdebug/          ; Configurable, but make sure the apache user has write access.
	xdebug.trace_output_name = trace.%R.%u.%r          ; Configurable, see xdebug docs for information.
	xdebug.collect_params = 4                          ; Required.
	xdebug.collect_return = 1                          ; Required.
	xdebug.collect_assignments = 1                     ; Required.
	xdebug.collect_includes = 1                        ; Required.

