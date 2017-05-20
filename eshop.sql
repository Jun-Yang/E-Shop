-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3333
-- Generation Time: May 19, 2017 at 04:45 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `ID` int(11) NOT NULL,
  `sessionID` varchar(50) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `createdTS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parent` varchar(50) DEFAULT NULL,
  `layer` int(11) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `postDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `name`, `parent`, `layer`, `description`, `status`, `postDate`) VALUES
(1, 'Electric Bicycle', NULL, 1, 'Electric Bicycle', 0, '2017-05-15'),
(2, 'Electric Scooter', NULL, 1, 'Electric Scooter', 0, '2017-05-15'),
(3, 'Scooter', NULL, 1, 'Electric Scooter', 0, '2017-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `invoiceStatus` varchar(10) DEFAULT NULL,
  `sendStatus` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` varchar(4000) DEFAULT NULL,
  `response` varchar(4000) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `postDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creatDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `ID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `origProductID` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orderpayment`
--

CREATE TABLE `orderpayment` (
  `ID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT '0',
  `userID` int(11) NOT NULL,
  `paymentID` int(11) DEFAULT NULL,
  `invoiceID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` varchar(6) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `totalBeforeTax` decimal(10,2) NOT NULL,
  `shippingBeforeTax` decimal(10,2) NOT NULL,
  `taxes` decimal(10,2) NOT NULL,
  `totalWithShippingAndTaxes` decimal(10,2) NOT NULL,
  `dateTimePlaced` datetime NOT NULL,
  `dateTimeShipped` datetime DEFAULT NULL,
  `status` enum('placed','shipped','cancelled','delivered') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `passresets`
--

CREATE TABLE `passresets` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `secretToken` varchar(50) NOT NULL,
  `expiryDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `paymentStatus` varchar(10) DEFAULT NULL,
  `paymentWay` varchar(10) DEFAULT NULL,
  `paymentDetails` varchar(100) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `payStatus` int(11) DEFAULT '0',
  `payDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `catID` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `title` varchar(200) NOT NULL,
  `imageData1` longblob,
  `imageMimeType1` varchar(100) NOT NULL,
  `imageName1` varchar(100) DEFAULT NULL,
  `imageData2` longblob,
  `imageMimeType2` varchar(100) DEFAULT NULL,
  `imageName2` varchar(100) DEFAULT NULL,
  `imageData3` longblob,
  `imageMimeType3` varchar(100) DEFAULT NULL,
  `imageName3` varchar(100) DEFAULT NULL,
  `modelNo` int(11) DEFAULT NULL,
  `modelName` varchar(50) DEFAULT NULL,
  `code` varchar(250) DEFAULT NULL,
  `desc1` varchar(100) NOT NULL,
  `desc2` varchar(100) DEFAULT NULL,
  `desc3` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) DEFAULT '1',
  `discount` decimal(3,2) DEFAULT NULL,
  `postDate` date DEFAULT NULL,
  `updateDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--


INSERT INTO `products` (`ID`, `catID`, `name`, `title`, `imageData1`, `imageMimeType1`, `imageName1`, `imageData2`, `imageMimeType2`, `imageName2`, `imageData3`, `imageMimeType3`, `imageName3`, `modelNo`, `modelName`, `code`, `desc1`, `desc2`, `desc3`, `price`, `stock`, `discount`, `postDate`, `updateDate`) VALUES
(1, 1, 'Electrical Scooter E1 325', 'Scooter E1', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 'fdsaf', '', 'fdsa', NULL, NULL, '1399.00', 400, '1.00', '2017-05-17', NULL),
(2, 1, 'Electric Bike 001', 'Yun ', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 'good yun', '', 'good yun bike', NULL, NULL, '2399.99', 200, '1.00', '2017-05-17', NULL),
(3, 1, '', 'Electrical Yun Bike', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 101, 'YunMa2', NULL, 'Good bike light weight', NULL, NULL, '1099.00', 10, '1.00', '2017-05-19', NULL),
(4, 1, '', 'Electrical Mi Bike ', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 105, 'YunMa2', NULL, 'light weight', NULL, NULL, '1299.00', 10, '1.00', '2017-05-19', NULL),
(5, 1, '', 'imageBinaryData', 0xffd8ffe000104a46494600010100000100010000ffdb00840009060712131215121213151515171817151515171517151515151517171715171715181d2820181a251d171521312125292b2e2e2e171f3338332d37282d2e2b010a0a0a0d0d0d190d0f152d1d191c2b2b2b2b37372b2b2b372b2b372d2b2d2b2b2b2d2b2b2b372b2d2b2b2b2b2b2b2b2b2b2d2d2b2d2d2b372b2b2b2d2b2b2b2dffc000110800b1011c03012200021101031101ffc4001c0000010403010000000000000000000000040203050600010708ffc4003b10000103020404040308010304030000000100021103040512213106415161132271813291a10714154252b1c1f0d162e1f1237382b2165372ffc4001501010100000000000000000000000000000001ffc4001511010100000000000000000000000000000001ffda000c03010002110311003f00e1c42d2b2d7c24211d841410a96da64a9866128da187008232c70f24ea1586d6dc3741badd1601a0577e10e171508a953e1e43aa0ae59e155aa7c2c27d95b70afb3baef01ce706f6dd743b3b4a74c431a07b291a5281cc22dcd2a4d61339444a3a5314c25e640e12b9afda9f0dd7af96a526e6ca4481bc2e8f996e5079a315b3ad49be7691ea214255aae5ea1c5b04a170d2daac041f9fcd5431ff00b2fb6aad1e0cd37011d4141c09f58a61d555ef88fece2e2d9ae7019da398548ab68e139842015f5132e7add44d928364a492b52b44a052718e4ccad6740707a58a8147f8ab5e2a092f1425d1b8008515e2ad78a82fb84e2cd6c29e38fb3b2e50cba239a58bf7f5283ad7e34c3d167e24c3cd72ca58a3faa2e8e2ce9dd0751a5720f34f78ca9386628a6db7c82785542e22ef2a0295ea5dd5c4b50572f7e24ed23a21ef1daa7a91d10319968b9339968bd0385c921c9b2e46e17686a3c08413dc2381f8cfcce1e50bac585b0600d020289e1ec345360006aac9468a0769b53ed7c2689492503e6b26cd74d44acca8096574fb6aa8fca9ea680f0e5b298614f0281aaed0e05ae120ae77c73c054ea83569f948d4b40dd749213752902083cd0795313e1aacd24c68142d4b1a837695e96e20e14cfab00f45cd388b0714890e108396398472482acd7149a80ad6ed410c5211b714c04190834b16e16420d2c58b1062c58b102d896136d4b082530faf0a6d978aad45f0a4e8d5413f42e91eeade55016ef524d7f9500b72ed53d49da20abb93b49fa20633ad664ce64a66a5019676e5e401bae9dc29c3f9007386aa0382b05322a3869c9748a0634407d08684fb6ba001288a480d6271ad4d30e89d6940a0d581894129a5027224884e4ad06a0530a741496353a020c958950b595036553b8f386fef148b983ce362adf59a79264ba447cd0794317a7568bcb1db83aa8e376e5d93ed4b85331f198d8fd4571eaf6994c2069cf94aa56d2b74e929e6e0172da26e1d49cda408199c32ccf40758efb208fa58784a7e0e4ec9546beaa56855d1056eae1c5a85a96e42b6d670280af401e482b442d293b9b351ef64204b52c2404b40e30a3addca3da8ba0e412b6ee524c3a288b77292a4ed100f70755b6541098bd7a8e17280b054ae05666a54007550cd2ae5c0b47cf283a361d4f23034720a5283d46b0a91b6080d694f30a1a9809ea3bc20298512364331c9c2f40f872535c86053ad40f06cecb1b51b3943da5dfa43813f2540fb48c71ed732d6938b039be255734c12261ac91b0d093ecb9e78003811208321c09907a83d507a1c14aceb9bf07f1c381146f1c5cdd9b58fc4ded50f31feadfaae94180ea20f307aa0c0e4a0e5a0c4a01069c1475605aef552690f603ba0afe3f6fe2507b7b2e20383ae2bd62ca6d275d5c746b47324f20bd0efa4c13227d551f89f18de8d086375cc5a009ea82956d81d0b4219440af71f9aa912ca6eff00430ee4752a3f1db3acd656f11ee797860712e26497870edf94ab3e1540022073d4955fe3cbec843019cce350fa346468ff00d9053061e53adb3704d9c4d6e9e2281efbab925d41c148e1f5b3e88cbcc35e04a0ae56a7a6ca02ec6aadb52d5c642afe278739ba941129692425040b6a228943353f49049502a4291d145d12a4293b4402e20745199549de2003503f4cabff0004c00b9eb0abbf0557dc20e84dabcd1142e239a8e151630c9ec827edee251d4aaca81b7ec5495ba094cc774b6b9081e422293e5012d29c0e4d30e8b1c5072bfb4571fbebcffa29c7711fe655728562edf4039aba7da75005f4de0c3830ff00e401dbeab9fd3ac490d682493fd1ec2504b52a44ea4fa0fcdee36f657be08e2ff0cfddab1397f238eecec7b7eca914ed5ac6ff00d578f11dbb41d403d7fc6dea9187512fa832c900c02274ef25077e65db4f34e78c3aaa1e0756a0195c640fdbfa1581958e928270d5086b8bc81204a8f372650f7171027aee802e24c59e29c33471dfa81d950c5c3661ce6033f9812ae7780174fcbb051d5387295405f0675813127bf6e683585006087b0f5c860fc9732fb419379527400e502360dd34edb9f757fb2c1eb50aed39890e3a8e51d23a7f745c8b8b713356f2e2a33e0754765e900c4fbc4fba010b13356473439aeeea90eaa7aa0b77093c17095d0afe8834e745c8b00b82d78857bad76f34e1002faa3c48079a5e23659c7250a243e55870e05da1414dbec0dd3a048660150f25d42961ecddd096f6d1669a20e5f57017b449403e89695d171bbda7a810a83895505fa20dd128ea45475128ea2e40d5c2658d4fd74cb5c1030d56ae12743d5fe8fd975b8f8893ee9dabc2542dda4b3740387e892daf0530d5aa8e4160a15240211b6f539a85b0ad206a8e6dc4774138da93aa7a938851342e7922a8d43ec826054d1379f542b2aa4baaea82b3c6f4f3ba9cfc39a0f3e5a7b2e717ecbb6d7200ca4c86900004740797a2ec35ed855395c244ea143e27c399eb0765f281aeb1246dc90566d385fc40d754104ef1ac1e6089d7d55b305c19b4be17120f23b0f6e4a42cb0dca391f428cf0a020c195a3e88ca0ecc34e4a3ea401afcb925da5fb5a48280caba494256131ea9aab88b75d7b2185d4b3374941abf10eedb1faca91b174c4ffc76548c5b8a18d3949d7fc27ec78d2d4119eb5369e85e27ea774175bac31ae7179df2b9a3b485e63c7ac0d0af52991195c74e82745e9cc3715a555a0b1ed20ed067f65c8bed8ec182a8a806aed6761d083d7f8841cc2520ac2b101f843e1caf746e41a7ecb9e5a9d42b3db5d794040ab870cd28fb6bf0d0a1ae6a28eaf7a46c82d97b8f40dd572fb1c7b8e84a89a95dcedca688404d7c41eedca14d4d56b2a496140eb6b275b7450be194a148a021d704ac155362914e0a483bfbf1a3d5017789661baa7fe267aa6ce266504fe724ee941e1455bdd660886bb9a09cb0709eca644112152df72429ec1710040694078ad088a7773cd3573424485155ab96e874413f42f639e89ff1c1d41552fbc3a77947dbde420b6591d651ed7c950d875d02d47d1a93cffca03081d3fbeaabbc5d8c7dd691aa18e706ea600903e8a52e2e88ff00080bea62b31d4de3cae69691ce08841cab12e38bcabad26d1a6d3266a540361304b8b5a0e9b4f30a2f05e37ac5e3ef04642402f1a6493b91d10dc4580d7b7cd46a35d941ff00a7500258f6f2d46c7b151b86e0956a0cac639d3ab9c01800749dd54770b0b12799234445d30b585beb095c0c1c6d98c78f331a1a49e8069f446e336ee2c394491b72515c27892b165419db9839c73364b7335bbb730da65566886b9e748064c4ce51ebce02e83c4fc3d52bd46340cb94bb318f8663e7b23704fb360d70a95ea073667235b9418d61c676ec1582c9c096ada1428c68e734170f5d503f6b76a2a52a753212403a82469f2d4296a75a2a797668e5f20b7c6b6c5f4a9b7580dd4759eaa0e0c681e8b62d8f4575760c0241c2c744154b7b533b29ab6a1a299b6c2c13b29eb5c1846c829356d49e4a3ee30f24ecba2d6c28269f84841cebf0e3d161c3cabed5c30219f878414b16052bee0ae02c027061c3a20a8330eec88a7867656fa78735114ec1bd1052dd86f648fc3fb2bcd4b11d10ceb41d1055aadcf44fdbebba29964d4ef8006c8156cf81a2328d5940000152369474d500d755d6f09be21e24ad5fd185095eb169d1075db0b9ccd086c4acf32ab708e37c9c7d35568ad893634dd0447c2e84535dd50779720eb0914af446ba47794164c36ef48e88f6622d1a03aaaa5b5f004693ea7f8526313601af3e8504d54bc077227d1269dd349127fbeaab9758ac8f281f53f595182a39cef8dcd33fac0fa105074cb5a2d78d448ee254853c35bd001e8a9583626f610d24d49e65c34f5565ab88bb2eff002d7e880d7d16d33e5da00f71b20318c458ca7eba0ff94e7df816b9a2663770d0cae43c618f5cd170a4f616efa821cd3b9d1dd3d47241727df537546386a76777e63f95297618f195ae831b681722c0711ab55fe239c1949b01ce26248830d1b93ca7babbe118dd3355bb12e0444198f53c90435bde3c5d8a712d0fd5dc8c72079ab97125c6a3a46dedcba28bc338798dacfb821ad24cb440263ac90a42f6939c4eba7ba0aad68e40fec421cfa2b5d3b11125c7e6567dd6911a8121056ed77d94f50aba236dece8e9a04567b666a4801056eeae0ca60d671e455b18eb777980042d54750076414c7979e4537e03cecd2af14cd13a0685bf169b4c651aa0a3fdddc357021337172d66e75578be14c832d31d821ab60341e038b08082b76d5039b32b6fba6b772ad3470fa2d05a186130786adcba1c77d820ac1be6bb6286754eeae63852d6743f543d5e08a6f3983e07aa0e37f8d3e127f1a7a890f5b9412bf8abf7571e13b90f19aab801c84ae761a4ed296c153f2e6f6941d6711b8b77681cdf9aa4e385ad24820a8116b5b7caf8eb0563898d67dc140edb620e638381d958687141eaab0034ec510dc32a120653aedc904fd6e22943fe3999d00e83f7413f872be5cde5f4ce27e495ff00c75cdf8ead369e85db2097a38a927424c6e6740a4598b02d82ff009493f3dbeaaacfc3806cfde184fe9d4040bf383bcc77d3d905bdd8965060d57fa3f281ea60c2ca38e6513e5693a005d52a103d018554156ac8cc09088a54aabfe1a663aedfba0b6d1e2cca7771f46b41f6dd48bf8b0919be80991eae11f4550660f5830bcb5add261cf027d7fc22709c16bd705c0374e65ed1000d749413575c64750403a449738aa8f10635e348dfdc944e27846401c72106621ed3b449227fb2a29b692444013a9274412185baad60da36f4dce70d9ad03493a924e9eeba770df0abadd99ee2b34d63f0b73e60c9e5ea80c22bdad9d9b9b41ed35ea007c43af59133a46fee1410ae438b8d7120c9fd3a6a4e922105eae2cea4e6654691f9813a7bf44bb8b5733cc5e00d3633a9eca9831ba539c5c0693a38004e7ef0975b8ca94b436abe00d5b9079bdf4ca82f14ed18e07ce5c604802354aa783542d390fa66d255170de37c8f765cce6feaa8368ee0f2520de31275f1096c9f2f9899eda6c82c34f0c70f8ea09da2635e8b2b60ed224827b75eeabafe230e730786ea8e00f9e0efcc1cdd04216e78daac3a9d1a7963f3b8e809d79033306020b6d0b2cae80c21b03eab2b58092e735e40fd3cd556df8ddce0d3543a76f2996cc7ff009e71285b8e27ad509ccf2299007c2e889e674dd05cc61d533086bb29da4ff212ff000faa340069b999e6a84de2abaa2f2e6d4243b40d0c2e601b75f29d36eeb2f78d2e9e229934b7986c927993f5e5a20bb917330480d3b6827d4a21cface2439e000771aedd572da9c5375b39e48db5001fa7b24d3e26b9d5aeaae83fa748e9263441d32ee85771395f263f2ee00e7083af85baa105f55c08da0c3be4b9c5ce3172cf3537d41237cdf10e52745155b12aaf25ee73cbb5979264f2d0f641d79d849f30f18b5bd5c447ef298fc66de9f95d70d9ff00b8171eab5dced7781fa8cf493aea8734c9d7f940ba37193501a7d44acad74e74cc09e8004fb6c2ae996954d4c0394ea7dff746d970ed7a8d2e2c7360eced27d25044b6e9c34063968954ee6a7273b9ec7a6eac0de11ac4890c6b4c482e25c3e5b9568b5c083290a6c0d2d064e6132fe64ed311cfa20e77f8b56ffec747494ba2eaf5410d0f70e7a69af75d12df87e835d9bc3617766651ed32a4061e01139a3a0200fd820e67f81d6003b28d44e5cd046b007af34d56b6b9f84b5c20c44cea396faaea35f0f8125b1beba93ec67d16e858d31e6c8d1df2c9f9a0e696987de3c802938f72207b95314f85ee3f3e49e7e69cbeb3fc2e834ac4ee069d6081aedea9e387e5893a9d2446bedba0e5971845402609d60003f985115ab39ba16c1ee7fd9754c7f871ee92da95a74f2830cf481d5733c42daa52a85b53e21ca248e80ca01054a8440e7ca3f92b18fa874cc473d4e813e5c5c0687d796ab6eb46c739f540c38b8c79c9eb2741a9f9e90b7f7589839bf565260a79a4349018396faa7285d0693e41e9247ec80165107607591a0da3d92cd83873d8c113acfec8d37a62453833c898f926e9ddd4074689ebd10268b2a013e2646b79e68d4e9a06c9275e89ea2f321a72d4d041009046e04900a58bd2eddadf580b62e8f79ec001081352890e8f044e91077f48dd6db5dc09ccc00cc196b9c4758e867a272e2b17381739fa01cc0dbba70df17fc4e24f3d75841942bbdd2035b4c01d0f9bb49275ec9ca4fafe622274e406874d754236e634cc6168de0db78e7280ea742a905aecba9dce8676d75d13de1d4a6e2d3e196824001c7511aea3789fa209d7b266477e72976f5604ce80edcfd9026f2ae58c8c3501891101a74e60f6ecb76ef2ede9ebc84076a7af51eeb2eee69e994bb5dd0d56ac186923a19d4205d4b8783b48dceec07f784317b9f2469d44923d96a9bc804171ff0065a6571d4f6e483546ce4ebfdee9d161bebfc21ead633a38a5d2ba83a9941aad45c00d4c739322530439bb9107e48ef1014e51c8441411907681af64af08f6f929275a0dc495b36e7ba0e9347313b7d138fa0fde0113b6df452603360b4dacce864201e9da93d125b62676fa189ebdd4a5afae89dad561c08411c6986c02489f6f9220d16f3fde744ef86d7197448d42dd5a8d06604a0d1634e91e80adba998100689ca5504ec9e9d10374d8fe6042c344920f97d63509e7b8e8b05074491a2049a44c07124287c4b876ddce2f75305c75277255928d4110a23885c5ccf23834841cf317a56e1d94d32d6b7a0dd55ef0904e490defbab26235bf554923d1572f6a03cd004da0e224909fa65a37036f749a2f6ed2b55e9b7741b764eab629b09d1c5354acf32328dab5a64a0ca56a77090f6092887ba7e13092cd37403e41cc9292d73648011b4da09d938fb668d504638346c3559529b7a230e54de76ca009b239689d35e7488443ae1ab4daccdc8403547b65346a9945d6a8c2740b1b55a392015d574d932da879847552d3b26cdaa065f109029844b6dceeb6020169760a42d6a81b85aa60745bca827b0db86153cda14c8921511b56364653c5aa01ba0e9b6ff1220f358b102edd36ef8962c40aa7ba555f882c5880aa68da1b2c5881f6a7abfc0b162001ea0388be13e8b1620e4b8afc6ef551d5162c41943745725b5880db3595d62c4196cb55775a5881eb5e6b2aecb162005c98a8b16206dc95c962c409a5ba74ad2c40e53453562c40eb76433d62c41a66e96f58b100af4a0b1620ffd9, 'image/jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'YunMa2', NULL, '1ewrfds', NULL, NULL, '111.00', 11, '1.00', '2017-05-19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `addressLine1` varchar(100) DEFAULT NULL,
  `addressLine2` varchar(100) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `TYPE` int(11) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `status` int(11) DEFAULT '0',
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `name`, `email`, `password`, `fname`, `lname`, `phone`, `addressLine1`, `addressLine2`, `state`, `city`, `code`, `TYPE`, `role`, `status`, `last_login`) VALUES
(5, 'jerry', 'Jerry@123.com', '$2y$10$erdahXcf.UC5ZbYph05haOli8tlgg0TcO5B7AarUSZwuQ5DUklM.u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, '2017-05-17 18:36:43'),
(6, 'Jerry003', 'Jerry003@123.com', '$2y$10$erdahXcf.UC5ZbYph05haOli8tlgg0TcO5B7AarUSZwuQ5DUklM.u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, '2017-05-17 18:36:43'),
(7, 'Jerry', 'Jerry@123.com', '$2y$10$erdahXcf.UC5ZbYph05haOli8tlgg0TcO5B7AarUSZwuQ5DUklM.u', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user', 0, '2017-05-17 18:36:43'),
(8, 'admin', 'admin@admin.org', '$2y$10$x5bXQG8.5cPuaz67dTEJae1cnpHT/jRRPSvM6mA8yF/XIalnHVFCO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 0, '2017-05-18 20:21:13');

-- --------------------------------------------------------


--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID1` int(11) DEFAULT NULL,
  `productID2` int(11) DEFAULT NULL,
  `productID3` int(11) DEFAULT NULL,
  `productID4` int(11) DEFAULT NULL,
  `productID5` int(11) DEFAULT NULL,
  `productID6` int(11) DEFAULT NULL,
  `productID7` int(11) DEFAULT NULL,
  `productID8` int(11) DEFAULT NULL,
  `productID9` int(11) DEFAULT NULL,
  `productID10` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `sessionID_2` (`sessionID`,`productID`),
  ADD KEY `sessionID` (`sessionID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `invoices_userIDfk_1` (`userID`),
  ADD KEY `invoices_ordersIDfk_1` (`orderID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `origProductID` (`origProductID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `orderpayment`
--
ALTER TABLE `orderpayment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `passresets`
--
ALTER TABLE `passresets`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `payments_userIDfk_1` (`userID`),
  ADD KEY `payments_ordersIDfk_1` (`orderID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `products_categoriesIDfk_1` (`catID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `wishlist_userIDfk_1` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orderpayment`
--
ALTER TABLE `orderpayment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `passresets`
--
ALTER TABLE `passresets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ordersIDfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `invoices_userIDfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `orderpayment`
--
ALTER TABLE `orderpayment`
  ADD CONSTRAINT `orderpayment_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `orderpayment_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`ID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ordersIDfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`ID`),
  ADD CONSTRAINT `payments_userIDfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_categoriesIDfk_1` FOREIGN KEY (`catID`) REFERENCES `categories` (`ID`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_userIDfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
