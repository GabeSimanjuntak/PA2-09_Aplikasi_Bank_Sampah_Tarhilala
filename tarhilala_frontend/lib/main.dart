import 'package:flutter/material.dart';
import 'services/auth_service.dart';
import 'screens/login/login_page.dart';
import 'screens/admin/dashboard_page.dart';
import 'screens/user/dashboard_page.dart';

void main() {
  runApp(MyApp());
}

class MyApp extends StatelessWidget {
  Future<Widget> getStartPage() async {
    bool login = await AuthService.isLoggedIn();

    if (!login) {
      return LoginPage();
    }

    String? role = await AuthService.getRole();

    if (role == 'admin') {
      return AdminDashboardPage();
    } else {
      return UserDashboardPage();
    }
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,

      // ROUTE
      routes: {
        '/login': (context) => LoginPage(),
        '/admin': (context) => AdminDashboardPage(),
        '/user': (context) => UserDashboardPage(),
      },

      // START PAGE (AUTO LOGIN)
      home: FutureBuilder(
        future: getStartPage(),
        builder: (context, snapshot) {
          if (snapshot.connectionState == ConnectionState.done) {
            return snapshot.data as Widget;
          }

          return Scaffold(
            body: Center(
              child: CircularProgressIndicator(),
            ),
          );
        },
      ),
    );
  }
}