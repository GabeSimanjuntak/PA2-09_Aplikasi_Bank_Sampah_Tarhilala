import 'package:flutter/material.dart';
import '../../services/auth_service.dart';
import 'widgets/bottom_navbar.dart';
import 'profile_page.dart';

class UserDashboardPage extends StatefulWidget {
  @override
  State<UserDashboardPage> createState() => _UserDashboardPageState();
}

class _UserDashboardPageState extends State<UserDashboardPage> {
  int currentIndex = 0;

  void logout(BuildContext context) async {
    await AuthService.logout();
    Navigator.pushNamedAndRemoveUntil(context, '/login', (_) => false);
  }

  Widget _getPage() {
    switch (currentIndex) {
      case 0:
        return _dashboardContent();
      case 1:
        return const Center(child: Text("Transaksi"));
      case 2:
        return const Center(child: Text("Jual"));
      case 3:
        return const Center(child: Text("Reward"));
      case 4:
        return const ProfilePage();
      default:
        return _dashboardContent();
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.grey.shade200,

      body: _getPage(),

      bottomNavigationBar: BottomNavbar(
        currentIndex: currentIndex,
        onTap: (index) {
          setState(() => currentIndex = index);
        },
      ),
    );
  }

  // ================= DASHBOARD CONTENT =================
  Widget _dashboardContent() {
    return SingleChildScrollView(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [

          // ================= HEADER =================
          Container(
            width: double.infinity,
            padding: const EdgeInsets.only(top: 60, bottom: 40),
            decoration: BoxDecoration(
              color: Colors.blue.shade800,
              borderRadius: const BorderRadius.vertical(
                bottom: Radius.circular(40),
              ),
            ),
            child: Column(
              children: [
                Stack(
                  clipBehavior: Clip.none,
                  alignment: Alignment.center,
                  children: [
                    Container(
                      width: 350,
                      height: 70,
                      decoration: BoxDecoration(
                        color: Colors.white,
                        borderRadius: BorderRadius.circular(20),
                        boxShadow: [
                          BoxShadow(
                            color: Colors.black.withOpacity(0.15),
                            blurRadius: 6,
                            offset: const Offset(0, 3),
                          )
                        ],
                      ),
                    ),
                    Positioned(
                      top: -20,
                      child: Image.asset(
                        "assets/images/logo_tarhilala.png",
                        height: 130,
                        fit: BoxFit.contain,
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),

          const SizedBox(height: 20),

          // ================= BOX BIRU =================
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 20),
            child: Container(
              width: double.infinity,
              height: 200,
              decoration: BoxDecoration(
                color: Colors.blue.shade400,
                borderRadius: BorderRadius.circular(25),
                boxShadow: [
                  BoxShadow(
                    color: Colors.black.withOpacity(0.18),
                    blurRadius: 10,
                    offset: const Offset(0, 5),
                  ),
                ],
              ),
            ),
          ),

          const SizedBox(height: 20),

          // ================= MENU =================
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 25),
            child: GridView.count(
              crossAxisCount: 4,
              shrinkWrap: true,
              physics: const NeverScrollableScrollPhysics(),
              mainAxisSpacing: 20,
              crossAxisSpacing: 15,
              childAspectRatio: 0.74,
              children: [
                menuItem("Jual Sampah"),
                menuItem("Jadwal\nPenjemputan"),
                menuItem("Panduan\nJual Sampah"),
                menuItem("Harga\nSampah"),
                menuItem("Bantuan"),
                menuItem("Transaksi"),
                menuItem("Reward"),
                menuItem("Poin"),
              ],
            ),
          ),

          const SizedBox(height: 25),

          // ================= HARGA =================
          sectionTitle("Harga Sampah"),

          const SizedBox(height: 15),

          SizedBox(
            height: 170,
            child: ListView(
              padding: const EdgeInsets.only(left: 20),
              scrollDirection: Axis.horizontal,
              children: [
                hargaCard(Icons.recycling),
                hargaCard(Icons.delete),
              ],
            ),
          ),

          const SizedBox(height: 25),

          // ================= BERITA =================
          sectionTitle("Berita Pilihan"),

          Padding(
            padding: const EdgeInsets.all(20),
            child: Container(
              height: 170,
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(20),
              ),
            ),
          ),

          const SizedBox(height: 30),
        ],
      ),
    );
  }

  // ================= MENU ITEM =================
  Widget menuItem(String title) {
    return Column(
      children: [
        Container(
          width: 55,
          height: 55,
          decoration: BoxDecoration(
            color: Colors.black,
            borderRadius: BorderRadius.circular(15),
          ),
        ),
        const SizedBox(height: 6),
        SizedBox(
          width: 70,
          child: Text(
            title,
            textAlign: TextAlign.center,
            maxLines: 2,
            style: const TextStyle(fontSize: 11, height: 1.2),
          ),
        ),
      ],
    );
  }

  // ================= TITLE =================
  Widget sectionTitle(String title) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Text(
            title,
            style: const TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
          ),
          const Text(
            "Lihat Semua",
            style: TextStyle(color: Colors.blue, fontSize: 14),
          ),
        ],
      ),
    );
  }

  // ================= CARD =================
  Widget hargaCard(IconData icon) {
    return Container(
      width: 180,
      margin: const EdgeInsets.only(right: 15),
      decoration: BoxDecoration(
        color: Colors.blue.shade100,
        borderRadius: BorderRadius.circular(20),
      ),
      child: Center(
        child: Icon(icon, size: 70, color: Colors.blue.shade700),
      ),
    );
  }
}