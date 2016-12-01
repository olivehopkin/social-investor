use acnf576;
GO



Drop table InvestmentGoal;
Go
Drop table InvestmentPortfolio;
Go
Drop table InvestmentAllocation;
Go
Drop table Member;
Go

create table Member(
	username VARCHAR(80) NOT NULL,
	passwordHash VARCHAR(50) NOT NULL,
	fName VARCHAR(80) NOT NULL,
	lName VARCHAR(80) NOT NULL,
	emailAddress VARCHAR(80) NOT NULL,
	dateOfBirth DATETIME,
	riskLevel INT NOT NULL,
	PRIMARY KEY(username)
);
GO

CREATE TABLE InvestmentAllocation(
	investmentAllocationId INT NOT NULL AUTO_INCREMENT,
    cashPercent DECIMAL(10.01),
	fixedIncomePercent DECIMAL(10.01),
	equityPercent DECIMAL(10.01),
	PRIMARY KEY(investmentAllocationId)
);
GO

CREATE TABLE InvestmentPortfolio(
	investmentPortfolioId INT NOT NULL AUTO_INCREMENT,
	contributionAmount DECIMAL(10,2),
    cashAmount DECIMAL(10,2),
	fixedIncomeAmount DECIMAL(10,2),
	equityAmount DECIMAL(10,2),
	investmentAllocationId INT,
	PRIMARY KEY(investmentPortfolioId),
	FOREIGN KEY(investmentAllocationId) REFERENCES InvestmentAllocation(investmentAllocationId)
);
GO


CREATE TABLE InvestmentGoal(
	investmentGoalId INT NOT NULL AUTO_INCREMENT,
    goalCategory VARCHAR(255),
	goalName VARCHAR(255),
	investmentDescription TEXT,
	targetAmount DECIMAL(10,2),
	timeHorizon INT(3),
	username VARCHAR(80),
	investmentPortfolioId INT (3),
	PRIMARY KEY(investmentGoalId),
	FOREIGN KEY(username) REFERENCES Member(username),
	FOREIGN KEY(investmentPortfolioId) REFERENCES InvestmentPortfolio(investmentPortfolioId)
);
GO

CREATE TABLE Comment(
	commentId INT NOT NULL AUTO_INCREMENT,
	commentText TEXT,
	commentDateTime DATETIME,
	username VARCHAR(80),
	investmentGoalId INT,
	PRIMARY KEY(commentId),
	FOREIGN KEY(username) REFERENCES Member(username),
	FOREIGN KEY(investmentGoalId) REFERENCES InvestmentGoal(investmentGoalId)
);
Go


insert into investmentallocation values (1, 100, 0, 0);
GO
insert into investmentallocation values (2, 90, 10, 0);
GO
insert into investmentallocation values (3, 40, 40, 20);
GO
insert into investmentallocation values (4, 20, 40, 40);
GO
insert into investmentallocation values (5, 0, 10, 90);
GO





