-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2022 at 11:13 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addAdmin` (IN `id` VARCHAR(13), IN `user` VARCHAR(50), IN `pass` TEXT)  NO SQL
insert into admin (aid,username,password) VALUES(id,user,pass)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` varchar(13) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `username`, `password`) VALUES
('61f0f82b4ea7b', 'Admin', '$2y$10$VJHiO/prC8T/IuRlY2IYs.1zjWeH1yU.w4IBfMOBhvr86PO/j/rjS');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `lid` varchar(13) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`lid`, `name`) VALUES
('61f30032a8b2d', 'Addis Ketema'),
('61f3003fe7ba9', 'Akaki Kality'),
('61f3004e043a5', 'Arada'),
('61f3006a84646', 'Bole'),
('61f3006c297bd', 'Gullele'),
('61f300773c4c6', 'Kirkos'),
('61f300849496c', 'Kolfe Keranio'),
('61f300a0172e7', 'Nifas Silk Lafto'),
('61f300a777d9f', 'Lideta'),
('61f300aec634c', 'Yeka'),
('61f3013e1167d', '4 Kilo'),
('61f301435b09d', 'Piyasa'),
('61f30147eb443', 'Jemo'),
('61f3015316018', 'Mexico'),
('61f3015b3cb0b', 'Abinet'),
('61f302d493bd3', 'Gerji'),
('61f302dfc9772', 'Ring Road');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `mid` varchar(13) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL,
  `aid` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`mid`, `name`, `description`, `img`, `aid`) VALUES
('61f3080d77e76', 'Acetaminophen', 'Acetaminophen is a pain reliever and a fever reducer.\r\n\r\nAcetaminophen is used to treat mild to moderate pain, to treat moderate to severe pain in conjunction with opiates, or reduce fever. Common conditions treated include headache, muscle aches, arthritis, backache, toothache, sore throat, colds, flu, and fevers.\r\n\r\nAcetaminophen is typically used orally but can be given intravenously.\r\n\r\n(You should not use this medication if you have severe liver disease.)', '61f3080d73fb1s-l640.jpg', '61f0f82b4ea7b'),
('61f308ca0000e', 'Cyclobenzaprine', 'Cyclobenzaprine is a muscle relaxant. It works by blocking nerve impulses (or pain sensations) that are sent to your brain.\r\n\r\nCyclobenzaprine is used together with rest and physical therapy to treat skeletal muscle conditions such as pain or injury.\r\n\r\nCyclobenzaprine may also be used for purposes not listed in this medication guide.\r\n\r\n(You should not use cyclobenzaprine if you have an allergy to the medication, a certain type of thyroid disorder (hyperthyroidism), heart block, congestive heart failure, a heart rhythm disorder, or you have recently had a heart attack.\r\n\r\nDo not use cyclobenzaprine if you have taken an MAO inhibitor in the past 14 days, such as isocarboxazid, linezolid, phenelzine, rasagiline, selegiline, or tranylcypromine)', '61f308c9ede18cyclobenzaprine-and-etoricoxib-500x500.jpg', '61f0f82b4ea7b'),
('61f3095074055', 'Januvia', 'Januvia (sitagliptin) is an oral diabetes medicine that helps control blood sugar levels. It works by regulating the levels of insulin your body produces after eating.\r\n\r\nJanuvia is used together with diet and exercise to improve blood sugar control in adults with type 2 diabetes mellitus.\r\n\r\nJanuvia is not for treating type 1 diabetes.\r\n\r\n(You should not use Januvia if you are in a state of diabetic ketoacidosis (call your doctor for treatment with insulin).\r\n\r\nCall your doctor if you have symptoms of heart failure--shortness of breath (even while lying down), swelling in your legs or feet, rapid weight gain.\r\n\r\nStop taking Januvia and call your doctor if you have symptoms of pancreatitis: severe pain in your upper stomach spreading to your back, with or without vomiting)', '61f309506dbf2januvia.jpg', '61f0f82b4ea7b'),
('61f309b46685c', 'Omeprazole', 'Omeprazole is a proton pump inhibitor that decreases the amount of acid produced in the stomach.\r\n\r\nOmeprazole is used to treat symptoms of gastroesophageal reflux disease (GERD) and other conditions caused by excess stomach acid. It is also used to promote healing of erosive esophagitis (damage to your esophagus caused by stomach acid).\r\n\r\nOmeprazole may also be given together with antibiotics to treat gastric ulcer caused by infection with Helicobacter pylori (H. pylori).\r\n\r\nOver-the-counter (OTC) omeprazole is used in adults to help control heartburn that occurs 2 or more days per week. The OTC brand must be taken as a course on a regular basis for 14 days in a row.\r\n\r\n(Omeprazole can cause kidney problems. Tell your doctor if you are urinating less than usual, or if you have blood in your urine.\r\n\r\nDiarrhea may be a sign of a new infection. Call your doctor if you have diarrhea that is watery or has blood in it.\r\n\r\nOmeprazole is not to used for the immediate relief of heartburn symptoms.\r\n\r\nOmeprazole may cause new or worsening symptoms of lupus. Tell your doctor if you have joint pain and a skin rash on your cheeks or arms that worsens in sunlight.\r\n\r\nYou may be more likely to have a broken bone while taking this medicine long term or more than once per day)', '61f309b465590a-packet-of-omeprazole-image-credit-siufaiho-2006.jpg', '61f0f82b4ea7b'),
('61f30a2d20226', 'Adderall', 'Adderall contains a combination of amphetamine and dextroamphetamine. Amphetamine and dextroamphetamine are central nervous system stimulants that affect chemicals in the brain and nerves that contribute to hyperactivity and impulse control.\r\n\r\nAdderall is used to treat attention deficit hyperactivity disorder (ADHD) and narcolepsy.\r\n\r\nAdderall may also be used for purposes not listed in this medication guide.\r\n\r\n(Adderall may be habit-forming, and this medicine is a drug of abuse. Tell your doctor if you have had problems with drug or alcohol abuse.\r\n\r\nStimulants have caused stroke, heart attack, and sudden death in people with high blood pressure, heart disease, or a heart defect.\r\n\r\nDo not use this medicine if you have used a MAO inhibitor in the past 14 days, such as isocarboxazid, linezolid, phenelzine, rasagiline, selegiline, or tranylcypromine or have received a methylene blue injection.\r\n\r\nAdderall may cause new or worsening psychosis (unusual thoughts or behavior), especially if you have a history of depression, mental illness, or bipolar disorder.\r\n\r\nYou may have blood circulation problems that can cause numbness, pain, or discoloration in your fingers or toes.\r\n\r\nCall your doctor right away if you have: signs of heart problems - chest pain, feeling light-headed or short of breath; signs of psychosis - paranoia, aggression, new behavior problems, seeing or hearing things that are not real; signs of circulation problems - unexplained wounds on your fingers or toes.\r\n\r\nYou may not be able to use Adderall if you have glaucoma, overactive thyroid, severe agitation, moderate to severe high blood pressure, heart disease or coronary artery disease, vascular disease, or a history of drug or alcohol addiction)', '61f30a2d1fcc70.jpg', '61f0f82b4ea7b'),
('61f30a92ca230', 'Cymbalta', 'Cymbalta (duloxetine) is a selective serotonin and norepinephrine reuptake inhibitor antidepressant (SSNRI). Duloxetine affects chemicals in the brain that may be unbalanced in people with depression.\r\n\r\nCymbalta is used to treat major depressive disorder in adults. It is also used to treat general anxiety disorder in adults and children who are at least 7 years old.\r\n\r\nCymbalta is also used in adults to treat nerve pain caused by diabetes (diabetic neuropathy), or chronic muscle or joint pain (such as low back pain and osteoarthritis pain).\r\n\r\nCymbalta is also used to treat fibromyalgia (a chronic pain disorder) in adults and children at least 13 years old.\r\n\r\n(Do not take Cymbalta within 5 days before or 14 days after you have used a MAO inhibitor, such as isocarboxazid, linezolid, phenelzine, rasagiline, selegiline, or tranylcypromine, or methylene blue injection.\r\n\r\nCymbalta should not be used if you have narrow angle glaucoma.\r\n\r\nSome young people have thoughts about suicide when first taking an antidepressant. Stay alert to changes in your mood or symptoms. Report any new or worsening symptoms to your doctor, such as: mood or behavior changes, anxiety, panic attacks, trouble sleeping, or if you feel impulsive, irritable, agitated, hostile, aggressive, restless, hyperactive (mentally or physically), more depressed, or have thoughts about suicide or hurting yourself.\r\n\r\nDo not stop using Cymbalta without first talking to your doctor)', '61f30a92c9c9cCymbalta6001PPS0.jpg', '61f0f82b4ea7b'),
('61f30b0a94fcc', 'Jardiance', 'Jardiance (empagliflozin) is an oral diabetes medicine that helps control blood sugar levels. Empagliflozin works by helping the kidneys get rid of glucose from your bloodstream.\r\n\r\nJardiance is used together with diet and exercise to improve blood sugar control in adults with type 2 diabetes mellitus.\r\n\r\nJardiance is used to lower the risk of death from heart attack, stroke, or heart failure in adults with type 2 diabetes who also have heart disease.\r\n\r\nJardiance is also used to reduce the risk of cardiovascular death and hospitalization for heart failure (when the heart is weak and cannot pump enough blood to the rest of your body) in adults with heart failure.\r\n\r\nJardiance is not for treating type 1 diabetes.\r\n\r\n(Stop taking Jardiance and call your doctor at once if you have signs of a serious side effect, such as stomach pain, vomiting, tiredness, or trouble breathing.\r\n\r\nYou should not use Jardiance if you have severe kidney disease or if you are on dialysis, or if you have diabetic ketoacidosis.\r\n\r\nTaking Jardiance can make you dehydrated, which could cause you to feel weak or dizzy (especially when you stand up).\r\n\r\nTell your doctor if you are sick with vomiting or diarrhea, or if you eat or drink less than usual.\r\n\r\nJardiance can cause serious infections in the penis or vagina. Get medical help right away if you have burning, itching, odor, discharge, pain, tenderness, redness or swelling of the genital or rectal area, fever, or if you don\'t feel well)', '61f30b0a942bfJardiance_Empagliflozin _HF_drug_0.jpeg', '61f0f82b4ea7b'),
('61f30b4f273b9', 'Onpattro', 'Onpattro (patisiran) a double-stranded small interfering ribonucleic acid (siRNA), formulated as a lipid complex injection.\r\n\r\nOnpattro is a prescription medicine used to treat polyneuropathy (damage of multiple nerves throughout the body) in adults with hereditary transthyretin-mediated amyloidosis (hATTR).\r\n\r\nOnpattro is given by intravenous (IV) infusion.\r\n\r\n(Follow all directions on your medicine label and package. Tell each of your healthcare providers about all your medical conditions, allergies, and all medicines you use.)', '61f30b4f26df0ONPATTRO.jpg', '61f0f82b4ea7b'),
('61f30b9d10daa', 'Doxycycline', 'Doxycycline is a tetracycline antibiotic that fights bacteria in the body.\r\n\r\nDoxycycline is used to treat many different bacterial infections, such as acne, urinary tract infections, intestinal infections, respiratory infections, eye infections, gonorrhea, chlamydia, syphilis, periodontitis (gum disease), and others.\r\n\r\nDoxycycline is also used to treat blemishes, bumps, and acne-like lesions caused by rosacea. It will not treat facial redness caused by rosacea.\r\n\r\nSome forms of doxycycline are used to prevent malaria, to treat anthrax, or to treat infections caused by mites, ticks, or lice.\r\n\r\n(You should not take doxycycline if you are allergic to any tetracycline antibiotic.\r\n\r\nChildren younger than 8 years old should use doxycycline only in cases of severe or life-threatening conditions. This medicine can cause permanent yellowing or graying of the teeth in children.\r\n\r\nUsing doxycycline during pregnancy could harm the unborn baby or cause permanent tooth discoloration later in the baby\'s life.)', '61f30b9d0fe81DOXYCYCLINE-100MG-UK.jpg', '61f0f82b4ea7b'),
('61f30be759b26', 'Kevzara', 'Kevzara (sarilumab) reduces the effects of a substance in the body that can cause inflammation.\r\n\r\nKevzara is used to treat moderate to severe rheumatoid arthritis in adults. Itis sometimes given together with other arthritis medicines.\r\n\r\nKevzara is usually given after other medications have been tried without successful treatment of symptoms.\r\n\r\nKevzara is also being studied in clinical trials as a potential treatment for patients who are severely or critically ill with COVID-19.\r\n\r\n(Kevzara affects your immune system. You may get infections more easily, even serious or fatal infections. Tell your doctor if you have a fever, chills, tiredness, cough, diarrhea, stomach pain, weight loss, skin sores, or painful urination.\r\n\r\nKevzara may cause you to have a tear in your stomach or intestines. This is more likely if you have diverticulitis or a stomach ulcer, or if you also take steroids, methotrexate, or an NSAID (nonsteroidal anti-inflammatory drug). Call your doctor right away if you have a fever and ongoing stomach pain.\r\n\r\nBefore and during your treatment with Kevzara, you will need frequent blood tests. Your treatment may be delayed or stopped based on the results of these tests.)', '61f30be753a5e1l-image-147.jpg', '61f0f82b4ea7b');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE `pharmacy` (
  `pid` varchar(13) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `img` text NOT NULL,
  `description` text NOT NULL,
  `mapLink` text NOT NULL,
  `lid` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`pid`, `name`, `email`, `password`, `img`, `description`, `mapLink`, `lid`) VALUES
('61f3052abdca6', 'Kenema Pharmacy', 'Kenemapharmacy1@gmail.com', '$2y$10$SH3O/HYfAOuUU9eeqOu5ZO6IiJXpeDbr1PBNn6rj2Qar8F5HZureO', '61f3052abd1b7Kenema Pharmacy.jpg', 'Kenema Pharmacy is a public pharmacy where you can find medicines with fair price. They have a lot of branches across Addis Ababa', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.540795407847!2d38.75514381460723!3d9.01433139353107!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85c08714aecf%3A0xa7d5ecc6d6497f3b!2sKenema%20Pharmacy!5e0!3m2!1sen!2set!4v1643280750172!5m2!1sen!2set', '61f3013e1167d'),
('61f305ae9a834', 'Gishen Pharmacy', 'Gishenpharmacy2@gmail.com', '$2y$10$EflEDdPBosJWxG2aSCiGwO/0s0ZAkGOIUFA/7h8QSDn/Wmye//Noe', '61f305ae948c2Gishen Pharmacy.jpg', 'This Pharmacy Provides uncompassionate and considerate for a patient requesting medicines', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.5182624801278!2d38.78563321434383!3d9.016396393529597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85723e2e8001%3A0xc6ffde19a028bf42!2sGishen%20Pharmacy!5e0!3m2!1sen!2set!4v1643281045557!5m2!1sen!2set', '61f300aec634c'),
('61f3068222e11', 'Anbessa Pharmacy', 'AnbessaPharmacy3@gmail.com', '$2y$10$Lqw.VT6T.9ehdNEXZw0Nfe3YAyKkgEQOSExwXr5wVHMza5rho3Xji', '61f3068222829Lion Pharmacy.jpg', 'You will get the best services you would have ever enjoyed and provides so many drugs purchase too', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.5182624801278!2d38.78563321434383!3d9.016396393529597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85723e2e8001%3A0xc6ffde19a028bf42!2sGishen%20Pharmacy!5e0!3m2!1sen!2set!4v1643281045557!5m2!1sen!2set', '61f301435b09d'),
('61f306c90a164', 'Heals Pharmacy', 'HealsPharmacy4@gmail.com', '$2y$10$e2nF.T5xvbxEEO.sEd..7ut43CzV5F0Fz50qDMGGRwIteI8pclw5y', '61f306c6b8fb8Heals Pharmacy.jpg', 'Heals Pharmacy is a private pharmacy where you can find medicines with fair prices with so many optional drug purchases too', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15762.981995478644!2d38.80521212002449!3d8.995550083792374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b859f908fcc3d%3A0x912974ce786d1d03!2sHeals%20Pharmacy!5e0!3m2!1sen!2set!4v1643282064669!5m2!1sen!2set', '61f302d493bd3'),
('61f3070d025fa', 'Solo-Da Pharmacy', 'Solodapharmacy4@gmail.com', '$2y$10$ji3eK4t.MYFuPcYuKmxsW.rR.XfTKjxMasFZHr0YJNfIGr7MyPaZm', '61f3070cf3c98Solo Da Pharmacy.jpg', 'Solo-Da Pharmacy is a private pharmacy where you can get so many drugs as you want and purchase fairly', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15762.981995478642!2d38.80521212002452!3d8.995550083792413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85291b499611%3A0x8fa1b1732012173a!2sSolo-Da%20Pharmacy!5e0!3m2!1sen!2set!4v1643282362268!5m2!1sen!2set', '61f302dfc9772');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `rid` varchar(13) NOT NULL,
  `uid` varchar(13) NOT NULL,
  `mid` varchar(13) NOT NULL,
  `counter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`rid`, `uid`, `mid`, `counter`) VALUES
('61f30c73ea69c', '61f2d3f569f03', '61f3080d77e76', 7),
('61f30e7db3fe5', '61f2d3f569f03', '61f308ca0000e', 5),
('61f31269780be', '61f2d3f569f03', '61f30a2d20226', 7),
('61f3179f6bad5', '61f2d3f569f03', '61f309b46685c', 2),
('61f3183be1680', '61f2d3f569f03', '61f30b0a94fcc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `sid` varchar(13) NOT NULL,
  `mid` varchar(13) NOT NULL,
  `pid` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`sid`, `mid`, `pid`) VALUES
('61f30c2c93d8e', '61f30a2d20226', '61f3052abdca6'),
('61f30c2e50ab1', '61f30be759b26', '61f3052abdca6'),
('61f30c307c5b2', '61f30b4f273b9', '61f3052abdca6'),
('61f30c3285cce', '61f3080d77e76', '61f3052abdca6'),
('61f30c36b4e78', '61f308ca0000e', '61f3052abdca6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` varchar(13) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`) VALUES
('61f2d3f569f03', 'Mikiyas', '$2y$10$tqUgpWLKfj8cSiKlezlec.1HjP8l4p.QQnnrjLgJPW18U5eLf9KQG'),
('61f2f04d1dd1b', 'Suru', '$2y$10$Oick.o23lOqxM3tI0LrUG.sis8t2LauJQx6lIeZr..CCsRXNikqSy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `fk_medicine_admin` (`aid`);

--
-- Indexes for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `fk_pharmacy_location` (`lid`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `fk_record_medicine` (`mid`),
  ADD KEY `fk_record_users` (`uid`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `fk_store_medicine` (`mid`),
  ADD KEY `fk_store_pharmacy` (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `fk_medicine_admin` FOREIGN KEY (`aid`) REFERENCES `admin` (`aid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pharmacy`
--
ALTER TABLE `pharmacy`
  ADD CONSTRAINT `fk_pharmacy_location` FOREIGN KEY (`lid`) REFERENCES `location` (`lid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `fk_record_medicine` FOREIGN KEY (`mid`) REFERENCES `medicine` (`mid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_record_users` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `fk_store_medicine` FOREIGN KEY (`mid`) REFERENCES `medicine` (`mid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_store_pharmacy` FOREIGN KEY (`pid`) REFERENCES `pharmacy` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
