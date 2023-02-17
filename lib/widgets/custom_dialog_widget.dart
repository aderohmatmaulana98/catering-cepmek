import 'package:cathering_mobile/themes/colors.dart';
import 'package:cathering_mobile/widgets/custom_text_widget.dart';
import 'package:flutter/material.dart';
import 'package:flutter_screenutil/flutter_screenutil.dart';

class LoadingDialog extends StatelessWidget {
  const LoadingDialog({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: Column(
        children: const [
          CircularProgressIndicator(
            valueColor: AlwaysStoppedAnimation(kPrimaryColor),
            backgroundColor: Colors.white,
          ),
          SizedBox(height: 16),
          Text(
            'Loading . . .',
            style: TextStyle(
              fontWeight: FontWeight.w500,
              fontSize: 14,
            ),
          ),
        ],
      ),
    );
  }
}

class ErrorDialog extends StatelessWidget {
  const ErrorDialog({
    Key? key, required this.message, required this.statusCode,
  }) : super(key: key);

  final String message;
  final String statusCode;

  @override
  Widget build(BuildContext context) {
    return AlertDialog(
      title: CustomTextWidget(
        text: 'Error',
        size: 16.sp,
        weight: FontWeight.w600,
      ),
      content: Text('$message ($statusCode)'),
      actions: [
        TextButton(
          onPressed: ()=> Navigator.pop(context), 
          child: CustomTextWidget(
            text: 'Back',
            size: 14.sp,
            color: kPrimaryColor,
          )
        )
      ],
    );
  }
}