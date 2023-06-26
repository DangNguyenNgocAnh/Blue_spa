<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Apointment;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Department;
use App\Models\Package;
use App\Models\User;
use App\Models\UserCoupon;
use App\Models\UserPackage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Department::factory(6)->sequence(
            ['name' => 'Admin', 'code' => 1002],
            ['name' => 'Manager', 'code' => 1003],
            ['name' => 'Team Leader', 'code' => 1004],
            ['name' => 'Staff', 'code' => 1005],
            ['name' => 'Customer', 'code' => 1006],
            ['name' => 'Other', 'code' => 1007],

        )->create();
        User::factory(5)->sequence(
            [
                'fullname' => 'Admin',
                'phone_number' => '0702751033',
                'code' => 1001,
                'email' => 'admin@gmail.com',
                'department_id' => 1,
            ],
            [
                'fullname' => 'Nguyen Thi Mai',
                'phone_number' => '0702753433',
                'code' => 2001,
                'email' => 'manager@gmail.com',
                'department_id' => 2,

            ],
            [
                'fullname' => 'Pham Thi Chi',
                'phone_number' => '0702323433',
                'code' => 3001,
                'email' => 'staff@gmail.com',
                'department_id' => 4,

            ],
            [
                'fullname' => 'Hoang Ha Nhi',
                'phone_number' => '0242753433',
                'code' => 4001,
                'email' => 'customer@gmail.com',
                'department_id' => 5

            ],
            [
                'fullname' => 'Nguyen Van Yen Mai',
                'phone_number' => '0702746433',
                'code' => 5001,
                'email' => 'leader@gmail.com',
                'department_id' => 3,

            ]
        )->create();
        User::factory(5)->sequence(
            [
                'fullname' => 'Admin',
            ],
            [
                'fullname' => 'Nguyen Thi Mai',
            ],
            [
                'fullname' => 'Pham Thi Chi',
            ],
            [
                'fullname' => 'Hoang Ha Nhi',
            ],
            [
                'fullname' => 'Nguyen Van Yen Mai',
            ]
        )->create();
        User::factory(100)->create();
        Category::factory(4)->sequence(
            ['name' => 'Chăm sóc '],
            ['name' => 'Điều trị'],
            ['name' => 'Thẩm mỹ'],
            ['name' => 'Phun xăm'],

        )->create();
        Apointment::factory(20)->create();
        Package::factory(13)->sequence(
            [
                'category_id' => 4,
                'name' => 'Phun xăm chân mày 3D ',
                'description' => 'Loại phun xăm này giúp tạo hiệu ứng lông mày tự nhiên hơn, giúp chân mày trông rậm và đẹp hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm môi 3D ',
                'description' => ' Phương pháp này sử dụng nhiều màu sắc khác nhau để tạo hiệu ứng 3D cho đôi môi, giúp chúng trông đầy đặn và sống động hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm mí mắt ',
                'description' => 'Loại phun xăm này giúp tăng độ sâu và độ dày của đường viền mí mắt, giúp mắt trông lớn hơn và sáng hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm chân mày 6D ',
                'description' => 'Loại phun xăm này sử dụng kỹ thuật thêu cực kỳ tỉ mỉ để tạo hiệu ứng lông mày tự nhiên và sống động hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm bọng mắt ',
                'description' => 'Loại phun xăm này giúp tạo hiệu ứng bọng mắt tự nhiên, giúp mắt trông sâu hơn và cuốn hút hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm thêu lông mày',
                'description' => 'Loại phun xăm này sử dụng kỹ thuật thêu để tạo dáng lông mày tự nhiên và đẹp mắt hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm lông mày ombre ',
                'description' => 'Loại phun xăm này giúp tạo hiệu ứng màu gradient cho lông mày, giúp chúng trông tự nhiên hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm mắt',
                'description' => 'Loại phun xăm này giúp tăng độ sâu và độ dày của đường viền mắt, giúp mắt trông to hơn và đôi mắt được làm nổi bật hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm môi',
                'description' => 'Phương pháp này giúp tô điểm màu sắc cho đôi môi, giúp chúng trông đầy đặn và quyến rũ hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm chân mày',
                'description' => 'Loại phun xăm này giúp tạo dáng chân mày tự nhiên và đẹp mắt hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm thẩm mỹ',
                'description' => 'Loại phun xăm này giúp che phủ các khuyết điểm trên da, giúp da trông đẹp tự nhiên và mịn màng hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm vết thâm',
                'description' => 'Loại phun xăm này giúp tạo hiệu ứng che phủ các vết thâm, sẹo hoặc tàn nhang trên da, giúp da trông đẹp và mịn màng hơn.'
            ],
            [
                'category_id' => 4,
                'name' => 'Phun xăm cằm ',
                'description' => 'Loại phun xăm này giúp tạo đường nét cằm rõ ràng và đẹp mắt hơn, giúp khuôn mặt trông thon gọn hơn..'
            ],



        )->create();
        Package::factory(10)->sequence(
            [
                'category_id' => 3,
                'name' => 'Phẩu thuật nâng mũi',
                'description' => 'Phương pháp này giúp cải thiện hình dáng mũi, giúp mũi trông đẹp tự nhiên và hài hòa hơn với khuôn mặt.'
            ],
            [
                'category_id' => 3,
                'name' => 'Phẫu thuật nâng ngực',
                'description' => 'Phương pháp này giúp tăng kích thước và độ đàn hồi của vòng ngực, giúp chúng trông đầy đặn và quyến rũ hơn.'
            ],
            [
                'category_id' => 3,
                'name' => 'Phẫu thuật thay đổi hình dáng cơ thể',
                'description' => 'Bao gồm các phương pháp như thay đổi hình dáng bụng, đùi, mông, giúp cải thiện hình dáng cơ thể và tự tin hơn với bản thân.'
            ],
            [
                'category_id' => 3,
                'name' => 'Phẫu thuật thẩm mỹ mắt',
                'description' => 'Bao gồm các phương pháp thẩm mỹ như nâng mí giúp mắt trông to hơn và sáng hơn.'
            ],
            [
                'category_id' => 3,
                'name' => 'Phẫu thuật nâng cơ ',
                'description' => 'Giúp cải thiện hình dáng khuôn mặt và tự tin hơn với bản thân.'
            ],
            [
                'category_id' => 3,
                'name' => 'Phẩu thuật cắt mí',
                'description' => 'Giúp cải thiện hình dáng khuôn mặt và tự tin hơn với bản thân.'
            ],
            [
                'category_id' => 3,
                'name' => 'Phẫu thuật tạo hình môi',
                'description' => 'Phương pháp này giúp cải thiện hình dáng môi, giúp chúng trông đầy đặn và quyến rũ hơn.'
            ],
            [
                'category_id' => 3,
                'name' => 'Phẫu thuật nâng mông',
                'description' => 'Phương pháp này giúp tăng kích thước và độ đàn hồi của mông, giúp chúng trông đầy đặn và quyến rũ hơn.'
            ],
            [
                'category_id' => 3,
                'name' => 'Phẫu thuật thẩm mỹ cổ',
                'description' => 'Phương pháp này giúp cải thiện hình dáng cổ và giảm các dấu hiệu lão hóa trên cổ, giúp khuôn mặt trông trẻ trung hơn.'
            ],
            [
                'category_id' => 3,
                'name' => 'Phẫu thuật xóa nếp nhăn',
                'description' => 'Phương pháp này giúp làm mờ các nếp nhăn và làm trẻ hóa làn da, giúp da trông trẻ trung và tươi sáng hơn.'
            ],
        )->create();
        Package::factory(12)->sequence(
            [
                'category_id' => 2,
                'name' => 'Massage thư giãn',
                'description' => 'Loại điều trị này giúp giảm căng thẳng và giải tỏa stress, giúp cơ thể thư giãn và tinh thần sảng khoái hơn.'
            ],
            [
                'category_id' => 2,
                'name' => 'Massage chữa bệnh',
                'description' => 'Loại điều trị này giúp giảm đau, mệt mỏi, cải thiện khả năng miễn dịch và tăng cường sức khỏe cho cơ thể.'
            ],
            [
                'category_id' => 2,
                'name' => 'Thải độc cơ thể',
                'description' => 'Loại điều trị này giúp loại bỏ độc tố và chất cặn trong cơ thể, giúp cơ thể sạch sẽ và khỏe mạnh hơn.'
            ],
            [
                'category_id' => 2,
                'name' => 'Trị liệu bằng đá nóng lạnh',
                'description' => 'Loại điều trị này sử dụng đá nóng và lạnh để kích thích tuần hoàn máu, giúp cơ thể thư giãn và giảm đau nhức.'
            ],
            [
                'category_id' => 2,
                'name' => 'Khoáng chất và muối biển',
                'description' => 'Loại điều trị này sử dụng các khoáng chất và muối biển để tẩy tế bào chết và làm sạch da, giúp cơ thể trông khỏe mạnh và sáng bóng hơn.'
            ],
            [
                'category_id' => 2,
                'name' => 'Trị liệu bằng ánh sáng',
                'description' => 'Loại điều trị này sử dụng ánh sáng để kích thích sản xuất collagen trên da, giúp cải thiện độ đàn hồi và làm giảm các nếp nhăn trên da.'
            ],
            [
                'category_id' => 2,
                'name' => 'Trị liệu bằng tinh dầu',
                'description' => 'Loại điều trị này sử dụng các tinh dầu thiên nhiên để thư giãn và giảm căng thẳng, giúp cơ thể thư giãn và tinh thần sảng khoái hơn.'
            ],
            [
                'category_id' => 2,
                'name' => 'Trị liệu bằng đèn LED',
                'description' => 'Loại điều trị này sử dụng đèn LED để kích thích sự sản xuất collagen và tăng cường tuần hoàn máu, giúp giảm các nếp nhăn và cải thiện độ đàn hồi của da.'
            ],
            [
                'category_id' => 2,
                'name' => 'Trị liệu bằng đá nóng',
                'description' => 'Loại điều trị này sử dụng đá nóng để giảm đau và mệt mỏi trên cơ thể, giúp cơ thể thư giãn và tinh thần sảng khoái hơn.'
            ],
            [
                'category_id' => 2,
                'name' => 'Trị liệu bằng phương pháp châm cứu',
                'description' => 'Loại điều trị này sử dụng kim châm cứu để kích thích các điểm trên cơ thể, giúp giảm đau, mệt mỏi và cải thiện sức khỏe tổng thể.'
            ],
            [
                'category_id' => 2,
                'name' => 'Trị liệu bằng tinh chất hữu cơ',
                'description' => 'Loại điều trị này sử dụng các tinh chất hữu cơ để dưỡng ẩm và cải thiện độ đàn hồi của da, giúp da trông trẻ trung và khỏe mạnh hơn.'
            ],
            [
                'category_id' => 2,
                'name' => 'Trị liệu bằng tia laser',
                'description' => 'Loại điều trị này sử dụng tia laser để làm giảm các nếp nhăn trên da, giúp da trông trẻ trung và tươi sáng hơn.'
            ],
        )->create();
        Package::factory(13)->sequence(
            [
                'category_id' => 1,
                'name' => 'Chăm sóc móng tay và chân',
                'description' => 'Loại điều trị này giúp làm sạch, cắt, đánh bóng và sơn móng tay và chân, giúp móng tay và chân trông đẹp và khỏe mạnh hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc vùng mắt',
                'description' => 'Loại điều trị này giúp làm giảm quầng thâm và bọng mắt, giúp vùng da quanh mắt trông sáng và tươi trẻ hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng oxy',
                'description' => 'Loại điều trị này sử dụng oxy để làm giảm các nếp nhăn và làm trẻ hóa da, giúp da trông tươi trẻ và khỏe mạnh hơn.                '
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng hơi nước',
                'description' => 'Loại điều trị này sử dụng hơi nước để làm sạch da, giúp loại bỏ tế bào chết và làm sạch lỗ chân lông, giúp da trông sáng và mịn màng hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng tinh chất',
                'description' => 'Loại điều trị này sử dụng các tinh chất thiên nhiên để dưỡng ẩm và cải thiện độ đàn hồi của da, giúp da trông trẻ trung và khỏe mạnh hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc cơ thể bằng tinh dầu',
                'description' => 'Loại điều trị này sử dụng tinh dầu thiên nhiên để thư giãn và giảm căng thẳng trên cơ thể, giúp cơ thể thư giãn và tinh thần sảng khoái hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng tinh chất và collagen',
                'description' => ' Loại điều trị này sử dụng tinh chất và collagen để cung cấp độ ẩm và tăng cường độ đàn hồi cho da, giúp da trông tươi trẻ và khỏe mạnh hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng tảo biển',
                'description' => ' Loại điều trị này sử dụng các tảo biển để làm sạch da và cung cấp độ ẩm, giúp da trông sáng và mịn màng hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng vàng',
                'description' => ' Loại điều trị này sử dụng vàng để làm giảm các nếp nhăn và làm trẻ hóa da, giúp da trông tươi trẻ và khỏe mạnh hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng tế bào gốc',
                'description' => 'Loại điều trị này sử dụng tế bào gốc để cải thiện độ đàn hồi của da và giúp da trông tươi trẻ hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng trà xanh',
                'description' => 'Loại điều trị này sử dụng trà xanh để làm sạch da và giảm các nếp nhăn, giúp da trông tươi trẻ và khỏe mạnh hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng tia cực tím',
                'description' => 'Loại điều trị này sử dụng tia cực tím để giảm mụn và cải thiện tình trạng da, giúp da trông sáng và tươi trẻ hơn.'
            ],
            [
                'category_id' => 1,
                'name' => 'Chăm sóc da mặt bằng enzim',
                'description' => 'Loại điều trị này sử dụng enzyme để làm sạch da và cải thiện tình trạng da, giúp da trông sáng và mịn màng hơn.'
            ],
        )->create();
        UserPackage::factory(50)->create();
        Coupon::factory(5)->sequence(
            [
                'name' => 'Discount 100.000 VND',
                'price' => 90000
            ],
            [
                'name' => 'Discount 200.000 VND',
                'price' => 180000
            ],
            [
                'name' => 'Discount 500.000 VND',
                'price' => 440000
            ],
            [
                'name' => 'Discount 1.000.000 VND',
                'price' => 850000
            ],
            [
                'name' => 'Discount 2.000.000 VND',
                'price' => 1600000
            ],
        )->create();
        // UserCoupon::factory(10)->create();
    }
}
