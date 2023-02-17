part of 'register_bloc.dart';

abstract class RegisterState extends Equatable {
  const RegisterState();
  
  @override
  List<Object> get props => [];
}

class RegisterInitial extends RegisterState {}

class RegisterSuccess extends RegisterState {
  
}

class RegisterFiled extends RegisterState {
  final ErrorModel error;

  const RegisterFiled(this.error);
}

class RegisterLoading extends RegisterState {
  
}